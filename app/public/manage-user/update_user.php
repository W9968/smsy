<?php

require_once "../../../vendor/autoload.php";

use App\controllers\UserController;
use App\models\User;

$request = new UserController('', '');


session_start();
$user = $request->findOne($_SESSION['uuid']);

if (empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == "false") {
    header("Location: ../auth");
}

$file_name = isset($_FILES['picture']) ? $_FILES['picture']['name'] : "";
$file_temp_name = isset($_FILES['picture']) ? $_FILES['picture']['tmp_name'] : "";
$new_image_name = basename($file_name);
$upload_path = "../../uploads/" . $new_image_name;

if (isset($_POST['update'])) {
    $request->update(new User(
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['cin'],
        $_POST['phone_number'],
        $_POST['gender'],
        $_POST['birth_date'],
        $_POST['address1'],
        $_POST['address2'],
        $_POST['state'],
        $_POST['city'],
        $_POST['postal_code'],
        $user['role'],
        $new_image_name,
        md5($_POST['password'])
    ), $_GET['user_id']);
    move_uploaded_file($file_temp_name, $upload_path);

    switch ($_SESSION['role']) {
        case 'STUDENT':
            header("Location: ../student-info/");
            break;
        case 'TEACHER':
            header("Location: ../teacher-info/");
            break;
        case 'ADMINISTRATOR':
            header("Location: ./users.php");
            break;
    }
}

$loggedUser = $request->findOne($_SESSION['uuid']);

?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Navasms - ADD USERS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="../assets/js/init-alpine.js"></script>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
        <div class="flex flex-col flex-1">
            <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
                <div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
                    <!-- Mobile hamburger -->
                    <!-- <button class="p-1 -ml-1 mr-5 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple" @click="toggleSideMenu" aria-label="Menu"> -->
                    <!-- </button> -->
                    <!-- Search input -->
                    <div class="flex justify-center flex-1 lg:mr-32">
                    </div>
                    <ul class="flex items-center flex-shrink-0 space-x-6">
                        <!-- Theme toggler -->
                        <li class="flex">
                            <button class="rounded-md focus:outline-none focus:shadow-outline-purple" @click="toggleTheme" aria-label="Toggle color mode">
                                <template x-if="!dark">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                    </svg>
                                </template>
                                <template x-if="dark">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                                    </svg>
                                </template>
                            </button>
                        </li>
                        <!-- Profile menu -->
                        <li class="relative">
                            <button class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none" @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account" aria-haspopup="true">
                                <img class="object-cover w-8 h-8 rounded-full" src="../../uploads/<?php echo $loggedUser['profile_picture'] ?>" alt="" aria-hidden="true" />
                            </button>
                            <template x-if="isProfileMenuOpen">
                                <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu" class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700" aria-label="submenu">
                                    <li class="flex">
                                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200" href="#">
                                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span><?php echo $loggedUser['first_name'] . " " . $loggedUser['last_name'] ?></span>
                                        </a>
                                    </li>
                                    <li class="flex">
                                        <a href="../auth/logout.php" class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                            </svg>
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </template>
                        </li>
                    </ul>
                </div>
            </header>
            <main class="h-full pb-16 overflow-y-auto">
                <div class="container px-6 mx-auto grid my-6">
                    <form method="POST" enctype="multipart/form-data">
                        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                            Informations
                        </h4>
                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <!-- first name -->
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">First Name</span>
                                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input value="<?php echo $user['first_name'] ?>" name="first_name" type="text" placeholder="first name..." class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                </div>
                            </label>
                            <!-- last name -->
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Last Name</span>
                                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input value="<?php echo $user['last_name'] ?>" name="last_name" type="text" placeholder="last name..." class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </label>
                            <!-- email -->
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Email</span>
                                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input value="<?php echo $user['email'] ?>" name="email" type="email" placeholder="foulen@foulen.xyz" class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-600 dark:text-gray-400">
                                    Your email should look like azerty@abc.xyz.
                                </span>
                            </label>
                            <!-- cin -->
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">National Card</span>
                                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input value="<?php echo $user['cin'] ?>" name="cin" type="number" placeholder="national id card..." maxlength="8" minlength="8" class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-600 dark:text-gray-400">
                                    Your national id should be exactly 8 figures long.
                                </span>
                            </label>
                            <!-- Phone number -->
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Phone Number</span>
                                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input value="<?php echo $user['phone'] ?>" name="phone_number" type="number" maxlength="8" placeholder="phone number +216..." maxlength="8" minlength="8" class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-600 dark:text-gray-400">
                                    Your Phone number should be exactly 8 figures long, no need to type the country code.
                                </span>
                            </label>
                            <!-- gender -->
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Gender</span>
                                <div class="relative pt-2 text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <div>
                                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                            <input <?php if ($user['gender'] == 'MALE') echo 'checked' ?> type="radio" name="gender" required value="MALE" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
                                            <span class="ml-2">Male</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                            <input <?php if ($user['gender'] == 'FEMALE') echo 'checked' ?> type="radio" name="gender" required value="FEMALE" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
                                            <span class="ml-2">Female</span>
                                        </label>
                                    </div>
                                </div>
                            </label>
                            <!-- birth date -->
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Phone Number</span>
                                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input value="<?php echo $user['birth'] ?>" name="birth_date" type="date" value="<?php echo date('Y-m-d'); ?>" class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                            </label>
                            <!--  -->
                        </div>
                        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                            Detailed Informations
                        </h4>
                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <!-- address 1 -->
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Address 1</span>
                                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input value="<?php echo $user['adress1'] ?>" name="address1" type="text" placeholder="location..." class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <svg class="h-6 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </label>
                            <!-- address 2 -->
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Address 2</span>
                                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input value="<?php echo $user['adress2'] ?>" name="address2" type="text" placeholder="optional..." class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </label>
                            <!-- state -->
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">State</span>
                                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input value="<?php echo $user['state'] ?>" name="state" type="text" placeholder="state..." class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                        </svg>
                                    </div>
                                </div>
                            </label>
                            <!-- city -->
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">City</span>
                                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input value="<?php echo $user['city'] ?>" name="city" type="text" placeholder="city..." class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                    </div>
                                </div>
                            </label>
                            <!-- zip -->
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Postal Code</span>
                                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input value="<?php echo $user['zip'] ?>" name="postal_code" type="number" placeholder="zip..." minlength="3" class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                        </svg>
                                    </div>
                                </div>
                            </label>
                            <!--  -->
                        </div>
                        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                            Settings
                        </h4>
                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Password</span>
                                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input value="<?php echo $user['cin'] ?>" name="password" type="password" placeholder="city..." class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                            </label>

                            <div class="mt-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="user_avatar">Upload file</label>
                                <input id="user_avatar" name="picture" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" type="file">
                                <div class="shrink-0">
                                    <img id="profile_picture" class="mt-2 h-12 w-12 object-cover rounded-full" src="../../uploads/<?php echo $user['profile_picture'] ?> " alt="Current profile photo" />
                                </div>

                                <span class="text-xs text-gray-600 dark:text-gray-400">
                                    A profile picture is useful to confirm your are logged into your account
                                </span>

                            </div>
                            <div class="mt-4">
                                <span class="text-xs text-yellow-700 dark:text-yellow-400">
                                    All account types are restricted on default, so users can't access their accounts unless they are unrestricted, after a user is added only an admin can activate an account.
                                </span>
                            </div>
                            <!-- button -->
                            <div class="mt-6">
                                <button name="update" class="w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    Update Profile
                                </button>
                            </div>
                            <!--  -->
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <script src="../assets/js/file-upload.js"></script>
</body>

</html>