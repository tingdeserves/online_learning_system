<!--set timezone and date-->
<?php   $dateobj=date_create("2023-03-31 12:40:57",timezone_open('America/New_York')); //create a date obj
        $timezoneobj=date_timezone_get($dateobj);  //create a timezone obj
        //using date/timezone functions:
        $timezoneout=timezone_name_get($timezoneobj);  //return: America/New_York
        $time =date_format($dateobj,"H:i:s"); //return: 12:40:57
        $dateout=date_format($dateobj,"d/m/Y"); //return: 31-03-2023
?>

<!--data validation in controllers and views-->
<?php // in controller
        $rules = [
                "username"=>"required|alpha_numeric|max_length[20]|min_length[4]",
                "email"=>"required|valid_email",
            ];
        if(! $this->validate($rules)){   //if false(not match the rules)
                return view("input");
        }
?>
        <!--in views-->
        <?= validation_list_errors() ?> <!--it will show the error messages-->