<?php 
//Security Services Class goes here
class SecurityService{
    public function sanitizeInputs($inputData){
        //This will sanitize every foriegn input
        $inputData=strip_tags($inputData);
        $inputData=htmlspecialchars($inputData);
        $inputData=stripslashes($inputData);
        //$inputData=escapeshellcmd($inputData);
        $inputData=htmlentities($inputData, ENT_QUOTES, 'UTF-8');
        return $inputData;
    }

    function generateCSRF(){
        //This will generate a token hash for checking form submission are done within the page and not by robots
            $token=bin2hex(openssl_random_pseudo_bytes(24));
            //$_SESSION['_generatedCSRF']=$token;
            return $token;
    }
    
    public function generateProgramHash(String $data){
        //This will generate hash data for use all through this system sha1(
        $saltedData=bin2hex(openssl_random_pseudo_bytes(24)).$data;
        return sha1($saltedData); 
    }

    function generateHashBcrypt($inputData){
        $generatedHash = password_hash($inputData, PASSWORD_DEFAULT);
        return $generatedHash;
    }

    function generate_reset_token($user_key)
    {
        $token_generated=null;
        $token_time=time();
        $token_type="reset";
        $audit_ob=new AuditService();
        //Generate New Token
        if (function_exists('com_create_guid') === true)
        {
            $token_generated=trim(com_create_guid(), '{}');
        }
        $token_generated=sprintf('%04g', mt_rand(0, 9999), mt_rand(0, 9999), mt_rand(0, 9999), mt_rand(1111, 9999), mt_rand(2445, 4978), mt_rand(0, 9999), mt_rand(0, 9999), mt_rand(0, 9999));
        //Insert new token to DB
        if($token_generated!=null){
            $dbHandler=new InitDB(DB_OPTIONS[2], DB_OPTIONS[0],DB_OPTIONS[1],DB_OPTIONS[3]);

            //this does an insertion first using the user_key
            //Verify if user has an active token already
            $active_user_token_stmt = $dbHandler->run("SELECT * FROM tokens_table WHERE user_key=?", [$user_key]);
            if ($active_user_token_stmt->rowCount()>0){
                //Token Exists update with new Token
                $update_user_token_stmt = $dbHandler->run("UPDATE tokens_table SET token__=?, token_time=?, token_status=? WHERE user_key=?", [$token_generated,$token_time,"1",$user_key]);
                if ($update_user_token_stmt->rowCount()==1){
                    //SEND SMS
                    $audit_ob->publishRecentActivity($user_key,"1","Another Token generated for user [$user_key - $token_generated]","0","0");
                    return $token_generated;
                }
                else{
                    $audit_ob->publishRecentActivity($user_key,"1","Failed to generate another token for user [$user_key - $token_generated]","2","1");
                    return false;
                } 
            }
            else{
                $stmt = $dbHandler->run("INSERT INTO tokens_table (user_key,token__,token_type,token_status, token_time) VALUES (?,?,?,?,?)", [$user_key,$token_generated,$token_type,"1",$token_time]);
                if ($stmt->rowCount()==1){
                    //SEND SMS
                    $audit_ob->publishRecentActivity($user_key,"1","Another Token generated for user [$user_key - $token_generated]","0","0");
                    return $token_generated;
                }
                else{
                    return false;
                } 
            }
            
        }
            
    }
}
?>