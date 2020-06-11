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

            // $curl = curl_init();
            // curl_setopt ($curl, CURLOPT_URL, "http://dummy.restapiexample.com/api/v1/employees");
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            // $result = curl_exec ($curl);
            // curl_close ($curl);
            //print $result;


            $arrayBasedJson = fetchAndDecode("http://dummy.restapiexample.com/api/v1/employees");
            
            $personalProfile = $arrayBasedJson["data"][0];
            $name = $personalProfile["employee_name"];
            $salary = $personalProfile["employee_salary"];
            $age = $personalProfile["employee_age"];
            var_dump($arrayBasedJson["data"][0]);
            print $name;
            print $salary;
            echo "<h3> Name: " . $name . "</h3>";
            echo "<h3> Salary" . $salary . "</h3>";
            echo "<h3> Age: " . $age . "</h3>";



            //http://dummy.restapiexample.com/api/v1/employees
            //https://jsonplaceholder.typicode.com/users
        ?>

</body>
</html>

        