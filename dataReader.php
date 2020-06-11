<!DOCTYPE html>
<html>
<body>

<?php 
        //function that gets JSON from specified url. Can be used for http and https
            function fetchAndDecode($url){
                
                $curl = curl_init();

                //setting option that indicates GET method
                curl_setopt ($curl, CURLOPT_URL, $url);
                //setting option that will return result instead of printing it
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                //setting option for https and http
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                //storing extracted json in result
                $result = curl_exec ($curl);
                //closing session
                curl_close ($curl);
                //decoding into array json for convenience
                $arrayBasedJson = json_decode($result,true);
                //returning for further use
                return $arrayBasedJson;
            }

            // function that shows employees from json
            function showEmployees($returnOrPrint){
            // calling function that returns array based json object
            $emplayeesArray = fetchAndDecode("http://dummy.restapiexample.com/api/v1/employees");
            // return Or print is made is I want to get just array and return it 
            //otherwise we print information about employee
            if($returnOrPrint){
                return $emplayeesArray;
            }
            else{
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
        }
            }
            // function that shows users and their info from url
            function showUsers($returnOrPrint){
                //calling function that will return array based json object of users
                $usersArray = fetchAndDecode("https://jsonplaceholder.typicode.com/users");
                //return or print for reusability of the function
                if($returnOrPrint){
                    return $usersArray;
                }
                else{
                //printing information about users
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
                
            }

            
            //function that posts new emplayee to a specific link
            function postNewEmployee(){
                //getting array based json objects
                $userArray = showUsers(true);
                $employeeArray = showEmployees(true);
                
                $newUser;// newUser stores a name of randomly selected user
                $userToCopy =0;//userToCopy stores random index for user in the userArray
                $emplToAdd=0;// this variable stores index for employeeArray to add a new employee
                //generating random indexes
                $userToCopy = random_int(0,sizeof($userArray)-1);
                $emplToAdd = random_int(0,sizeof($employeeArray)-1);
                //finding random user and retrieving a name
                $newUser = $userArray[$userToCopy]["name"];
                //retireving employee object and changing proprieties such as name, salary and age    
                $object = $employeeArray["data"][$emplToAdd];
                $object["employee_name"] = $newUser;
                $object["employee_salary"] = strval(random_int(3000,1000000));//random salary
                $object["employee_age"] = strval(random_int(20,70));//random age
                //calling function that will post new object
                connectAndPost("http://dummy.restapiexample.com/api/v1/employees",$object);
               
            }
            //function that post any json object into specified url
            function connectAndPost($url,$parcel){
                //creating session
                $curlpost = curl_init($url);
                //setting options such as Post method, http header, return transfer
                curl_setopt($curlpost,CURLOPT_POSTFIELDS,$parcel);
                curl_setopt($curlpost, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt($curlpost,CURLOPT_RETURNTRANSFER,true);
                //saving response from a server into result
                $result = curl_exec($curlpost);
                //closing session
                curl_close($curlpost);
                //printing server response
                echo "<h2> Response from the server </h2>";
                var_dump($result);
            }

            // first function to execute
            showEmployees(false);

            echo "<hr>";
            echo "<hr>";

            showUsers(false);

            postNewEmployee();

            $test = array(
                'title'=>'hello',
                'body'=>'lorem ipsum',
                'userId'=>'20'
            );

            $objectToSend = json_encode($test);
            connectAndPost('http://jsonplaceholder.typicode.com/posts', $objectToSend);

            //NOTE: POSTing to the employees list is not possible since the server only accepts get requests.
            // I tested this curl option on other rest api that allows post methdon and it works perfectly.
            // that is the url I used http://jsonplaceholder.typicode.com/posts
        ?>

</body>
</html>

        