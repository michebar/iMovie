<?php header('Content-Type: text/html; charset=utf-8');
  
require_once('database.php');

class quizRes{
    private $userName;
    private $res;
    private $comedy;
    private $romantic;
    private $action;
    private $horror;
        
    private function has_attribute($attribute){
        $object_properties=get_object_vars($this);
        return array_key_exists($attribute,$object_properties);
    }
    
    private function instantation($res_array){
        foreach ($res_array as $attribute=>$value){
            if ($result=$this->has_attribute($attribute))
                $this->$attribute=$value;
        }
    }
    
    public function find_res_by_userName($userName){
        global $database;
        $result_set=$database->query("select * from quiz_results where userName='$userName'");
        $found_user=$result_set->fetch_assoc();
		
        if ($found_user==null)
			return false;
        
        $this->instantation($found_user);
        return $this;
    }
    
    public static function add_results($userName,$q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$q10,$q11,$q12,$q13,$q14,$q15,$q16){
        global $database;
        for ($i = 0; $i < 16; $i++)
            $q[$i] = ${ 'q' . $i};
        $quizRes = new quizRes;
        $quizRes->set_res_algorithm($q);
        $sql="Insert into quiz_results(userName,q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,q11,q12,q13,q14,q15,q16,res,comedy,romantic,action,horror) values ('$userName',$q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$q10,$q11,$q12,$q13,$q14,$q15,$q16,$quizRes->res,$quizRes->comedy,$quizRes->romantic,$quizRes->action,$quizRes->horror)";
        $result=$database->query($sql);
        return $result;
    }
    
    public static function get_results_by_question($question, $genre){
        global $database;
        $result_set=$database->query("select count($question) as total from quiz_results where $question = $genre");
        $found_question=$result_set->fetch_assoc();
        
        return $found_question['total'];
    }
    
    public static function get_movie_rating($question){
        global $database;
        $result_set=$database->query("select avg($question) as avg from quiz_results");
        $found_question=$result_set->fetch_assoc();

        return round(($found_question['avg']),2);
    }
    
    public static function get_stats_of_res($genre){
        global $database;
        $result_set=$database->query("select count(*) as total from quiz_results");
        $totalReplies = $result_set->fetch_assoc();
        $genreReplies = quizRes::get_results_by_question('res', $genre);
        
        $answer = ($genreReplies/$totalReplies['total'])*100;
        
        return round($answer,2);
    }
    
    public function set_res_algorithm($q){
        // define movie genre codes
        $comedy_code = 1;
        $romantic_code = 2;
        $action_code = 3;
        $horror_code = 4;
        
        $comedy_freq = 0;
        $romantic_freq = 0;
        $action_freq = 0;
        $horror_freq = 0;
        
        // sum genre frequncy in questions 1-4
        for ($i = 0; $i < 4; $i++){
            if ($q[$i] == $comedy_code)
                $comedy_freq++;
            else if ($q[$i] == $romantic_code)
                $romantic_freq++;
            else if ($q[$i] == $action_code)
                $action_freq++;
            else if ($q[$i] == $thriller_code)
                $horror_freq++;
        }
        
        // get frequency precentage out of questions 1-4
        if ($comedy_freq != 0)
            $comedy_answers = $comedy_freq/4;
        if ($romantic_freq != 0)
            $romantic_answers = $romantic_freq/4;
        if ($action_freq != 0)
            $action_answers = $action_freq/4;
        if ($horror_freq != 0)
            $horror_answers = $horror_freq/4;
        
        // sum movie rating for each genre (quiestions 5-16)
        $comedy_rating = ($q[7]+$q[12]+$q[14])/15;
        $romantic_rating = ($q[10]+$q[11]+$q[13])/15;
        $action_rating = ($q[5]+$q[8]+$q[16])/15;
        $horror_rating = ($q[6]+$q[9]+$q[15])/15;

        // get the total score for each genre
        $this->comedy = ($comedy_rating*0.5 + $comedy_answers*0.5)*100;
        $this->romantic = ($romantic_rating*0.5 + $romantic_answers*0.5)*100;
        $this->action = ($action_rating*0.5 + $action_answers*0.5)*100;
        $this->horror = ($horror_rating*0.5 + $horror_answers*0.5)*100;
        
        // get the max score out of the genres
        $max_statistic = max($this->comedy,$this->romantic,$this->action,$this->horror);
        
        // init the right code for max genre to the res variable
        if ($max_statistic == $this->comedy)
            $this->res = 1;
        else if ($max_statistic == $this->romantic)
            $this->res = 2;
        else if ($max_statistic == $this->action)
            $this->res = 3;
        else if ($max_statistic == $this->horror)
            $this->res = 4;

    }
    
    public function get_userName(){
        return $this->userName;
    }
        
    public function get_name(){
        return $this->name;
    }
    
    public function get_res(){
        return $this->res;
    }
    
    public function get_comedy(){
        return $this->comedy;
    }
    
    public function get_romantic(){
        return $this->romantic;
    }
    
    public function get_action(){
        return $this->action;
    }
    
    public function get_horror(){
        return $this->horror;
    }
}

    
?>