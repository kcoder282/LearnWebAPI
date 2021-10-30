<?php
echo shell_exec("php artisan db:wipe");
echo shell_exec("php artisan migrate");

// echo shell_exec("php artisan db:seed user");
// echo shell_exec("php artisan db:seed courses");
// echo shell_exec("php artisan db:seed regis");
// echo shell_exec("php artisan db:seed chapters");
// echo shell_exec("php artisan db:seed lesson");
// echo shell_exec("php artisan db:seed processes");
// echo shell_exec("php artisan db:seed question");
// echo shell_exec("php artisan db:seed a_quizs");