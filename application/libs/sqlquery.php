<?php
    class Sql {
        private $database;
        private $tablename;
        private $columnlist;
        
        public function __construct($databaseName, $table, $columns){
        //set table name variable and columns for other functions
            $this->database = $databaseName;
            $this->tablename  = $table;
            $this->columnlist = $columns;
        }
        
        public function create(){
        // ???
        }
        
        public function insert($fields){
            $sqlString = "INSERT INTO " . $this->database . "." . $this->tablename  . " (";
            $valuesString = "";
            for ($i = 0; $i < count($this->columnlist); $i++){
                $sqlString .= $this->columnlist[$i];

                $valuesString .= ($fields[$i] === NULL)? 'NULL' : "'" . $fields[$i] . "'";
                if ($i < (count($this->columnlist) - 1)){
                    $sqlString .= ", ";
                    $valuesString .= ", ";
                }
            }
            $sqlString .= ") VALUES (" . $valuesString . ");";
            // echo $sqlString;
            return $sqlString;
        }

        public function update($fields, $key, $value){
            $sqlString = "UPDATE " . $this->database . "." . $this->tablename  . " SET ";
            foreach ($fields as $field_key => $field_value){
                $sqlString .= $field_key . "='" . $field_value . "'";
                $sqlString .= ", ";
            }
            $sqlString .= " WHERE " . $key . "='" . $value . "';";

            return $sqlString;
        }
    
        public function selectAll(){
        //SELECT * FROM database_name.table_name;
            $sqlString = "SELECT * FROM " . $this->database . "." . $this->tablename  . ";";
            return $sqlString;
        }
        
        public function findByKey($keyColumn, $keyValue){
            $sqlString = "SELECT * FROM " . $this->database . "." . $this->tablename  . " WHERE " . $keyColumn . '="' . $keyValue . '";';
            // echo $sqlString;
            return $sqlString;
        }
        
        //public function select($column, $pattern){
        //
        //}
        
        public function select($criteria){
            $sqlString = "SELECT " . $criteria . " FROM " . $this->database . "." . $this->tablename  . ";";
            return $sqlString;
        }
        
        public function preparedInsert(){
        // Insert into table based on "preset" insert, useful for forms?
            $sqlString = "INSERT INTO " . $this->database . "." . $this->tablename  . " (";
            for ($i = 0; $i < count($this->columnlist); $i++){
                $sqlString .= $this->columnlist[$i];
                $valuesString .= "?";
                if ($i < (count($this->columnlist) - 1)){
                    $sqlString .= ", ";
                    $valueString .= ", ";
                }
            }
            $sqlString .= ") VALUES (" . $valuesString . ");";

            return $sqlString;
            
        }

        public function selectFromOrder($select, $order){
        /*
        **NOT TESTED**
        Select from a table in the database. Returns in order specified. 

        SELECT $select 
        FROM database.tablename
        ORDER BY $order

        returns sql query string
        */
            $sqlString = "SELECT " . $select . "FROM " . $this->database . "." . $this->tablename . " ORDER BY " . $order . ";";
            return $sqlString;
        }
        public function get_message($select, $posting_id, $user_id){
            return "SELECT " . $select . "FROM " . $this->database . "." .$this->tablename . " WHERE postingID = '" . $posting_id . "' AND userID ='" . $user_id . "' ORDER BY timestamp DESC;";
            
        }

        public function get_message_student($select, $user_id){
            return "SELECT " . $select . "FROM " . $this->database . "." .$this->tablename . " WHERE userID ='" . $user_id . "' ORDER BY timestamp DESC;";
            
        }
        public function view_user_info($userID){
            return "SELECT * FROM student_tliu3.user_info WHERE id =" . $userID . ";";
        }
        public function selectFromWhere($select, $where){
        /*
        **NOT TESTED**
        Select from a table in the database where a condition is satisfied. Returns in order specified.

        SELECT $select 
        FROM database.tablename
        WHERE $where
        ORDER BY $order

        returns sql query string
        */
            $temp = str_replace('_', ' ', $where);
            $sqlString = "SELECT " . $select . " FROM " . $this->database . "." . $this->tablename . " WHERE " . $temp . ";";
            return $sqlString;
        }
        public function selectFromLike($select, $query)
        {
            $newQuery = explode(',', $query);
            $filters = str_replace('_', ' ', $newQuery[0]);
            //splits metadata into individual words to be used for comparison
            $metadata = explode ('_', $newQuery[1]);
            $searchbar = '';
            //concatenates %like statements
            foreach($metadata as $value)
            {
                $searchbar = $searchbar . " AND metadata LIKE '%" . $value . "%'";
            }
            $orderString = str_replace('_', ' ', $newQuery[2]);
            if($orderString !== ""){
                $orderString = " ORDER BY " . $orderString;
            }
            $sqlString = "SELECT " . $select . " FROM " . $this->database . "." . $this->tablename . " WHERE ". $filters . $searchbar . $orderString . ";";
            return $sqlString;
        }

        public function selectFromWhereOrder($select, $where, $order){
        /*
        **NOT TESTED**
        Select from a table in the database where a condition is satisfied. Returns in order specified.

        SELECT $select 
        FROM database.tablename
        WHERE $where
        ORDER BY $order

        returns sql query string
        */
            $sqlString = "SELECT " . $select . " FROM " . $this->database . "." . $this->tablename . " WHERE " . $where . " ORDER BY " . $order . ";";
            return $sqlString;
        }

        private function columnList($columns){
        //Returns a string of what each column is
            $sqlString;
            for ($i = 0; $i < count($this->columnlist); $i++){
                $sqlString .= $this->columnlist[$i];
                if ($i < (count($this->columnlist) - 1)){
                    $sqlString .= ", ";
                }
            }

            return $sqlString;
        }

        public function selectFromLikeLimit($select, $query, $start, $end)
        {
            $newQuery = explode(',', $query);
            $filters = str_replace('_', ' ', $newQuery[0]);
            //splits metadata into individual words to be used for comparison
            $metadata = explode ('_', $newQuery[1]);
            $searchbar = '';
            //concatenates %like statements
            foreach($metadata as $value)
            {
                $searchbar = $searchbar . " AND metadata LIKE '%" . $value . "%'";
            }
            $orderString = str_replace('_', ' ', $newQuery[2]);
            if($orderString !== ""){
                $orderString = " ORDER BY " . $orderString;
            }
            $sqlString = "SELECT " . $select . " FROM " . $this->database . "." . $this->tablename . " WHERE ". $filters . $searchbar . $orderString . " LIMIT " . $start . ", " . $end . ";";

            return $sqlString;
        }

        public function insert_message($fields){
            $sqlString = "INSERT INTO " . $this->database . "." . $this->tablename  . " (";
            $valuesString = "";
            for ($i = 0; $i < count($this->columnlist); $i++){
                $sqlString .= $this->columnlist[$i];

                if ($i === 4 || $i === 5){
                    $fields[$i] = str_replace('_', ' ', $fields[$i]);
                    echo($fields[$i]);
                }

                $valuesString .= ($fields[$i] === NULL)? 'NULL' : "'" . $fields[$i] . "'";
                if ($i < (count($this->columnlist) - 1)){
                    $sqlString .= ", ";
                    $valuesString .= ", ";
                }
            }
            $sqlString .= ") VALUES (" . $valuesString . ");";
            // echo $sqlString;
            return $sqlString;
        }

        public function insertUser($query)
        {
            $sqlString = "INSERT INTO " . $this->database . "." . $this->tablename;
            // for ($i = 1; $i < count($this->columnlist); $i++){
            //     $sqlString .= $this->columnlist[$i];
            //     if ($i < (count($this->columnlist) - 1)){
            //         $sqlString .= ", ";
            //     }
            // }
            $sqlString .= " VALUES (". implode(",",$query) . ");";

            return $sqlString;
        }

        public function insertTenant($query)
        {
            $sqlString = "INSERT INTO " . $this->database . "." . $this->tablename  . " VALUES " . $query . ";";
            echo ("SQL: " . $sqlString);
            return $sqlString;
        }

        
        // private function valuesList($fields, $columns){
            
        // }
        
        // private function selectWithCriteria($criteria){
            
        // }
        
        // private function placeholderList($columns){
            
        // }
    }
?>