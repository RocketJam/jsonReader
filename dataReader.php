<!DOCTYPE html>
<html>
<body>

<?php 
            function fetchAndDecode($url){
                $curl = curl_init();
                curl_setopt ($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec ($curl);
                curl_close ($curl);
                //print $result;
                $arrayBasedJson = json_decode($result,true);

                return $arrayBasedJson;
            }

            
            function showEmployees(){
            $emplayeesArray = fetchAndDecode("http://dummy.restapiexample.com/api/v1/employees");
            foreach($emplayeesArray["data"] as $emplayeerInfo){
                $color = 0;

                $name = $emplayeerInfo["employee_name"];
                $salary = $emplayeerInfo["employee_salary"];
                $age = $emplayeerInfo["employee_age"];

                echo "<hr>";
                echo "<h3> Name: " . $name . "</h3>";
                echo "<h3> Salary: " . $salary . "</h3>";
                echo "<h3> Age: " . $age . "</h3>";
                echo "<hr>";
                
            }
            //var_dump($emplayeesArray["data"][0]);
           
            }


            function showUsers(){
                $usersArray = fetchAndDecode("https://jsonplaceholder.typicode.com/users");
                //var_dump($usersArray);
                foreach($usersArray as $userInfo){
                    $id = $userInfo["id"];
                    $name = $userInfo["name"];
                    $username = $userInfo["username"];
                    $email = $userInfo["email"];

                    echo "<hr>";
                    echo "<h3> Id: " . $id . "</h3>";
                    echo "<h3> Name: " . $name . "</h3>";
                    echo "<h3> Email: " . $email . "</h3>";
                    echo "<hr>";

                }
                
            }

            function connectAndPost($url){
                $curlpost = curl_init($url);
                
                $newUser = array(
                    'title'=>'Excepteur sint occaecat',
                    'body'=>'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'userId'=>'10',
                );

                $newUserJson = json_encode($newUser);

                curl_setopt($curlpost,CURLOPT_POSTFIELDS,$newUserJson);
                curl_setopt($curlpost, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt($curlpost,CURLOPT_RETURNTRANSFER,true);
                $result = curl_exec($curlpost);
                curl_close($curlpost);
                //$response - json_decode($result);
                echo "<h2> Response from the server </h2>";
                var_dump($result);
            }

            
            showEmployees();

            echo "<hr>";
            echo "<hr>";

            showUsers();

            connectAndPost("http://jsonplaceholder.typicode.com/posts")
            
            



            // $curl = curl_init();
            // curl_setopt ($curl, CURLOPT_URL, "http://dummy.restapiexample.com/api/v1/employees");
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            // $result = curl_exec ($curl);
            // curl_close ($curl);
            //print $result;

            // function displayInfo($arrayJson,$arrayKeys){
            // echo "<h3>: " . $arrayJson . "</h3>";
            // echo "<h3> Salary" . $salary . "</h3>";
            // echo "<h3> Age: " . $age . "</h3>";

            // }



            //http://dummy.restapiexample.com/api/v1/employees
            //https://jsonplaceholder.typicode.com/users
        ?>

</body>
</html>

        