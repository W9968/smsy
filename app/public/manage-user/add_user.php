<?php

require_once "../../../vendor/autoload.php";

use App\controllers\UserController;
use App\models\User;

$request = new UserController('', '');

session_start();
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == "true") {
	if ($_SESSION['role'] != 'ADMINISTRATOR') {
		header("Location: ../404.html");
	}
} else {
	header("Location: ../auth");
}

$file_name = isset($_FILES['picture']) ? $_FILES['picture']['name'] : "";
$file_temp_name = isset($_FILES['picture']) ? $_FILES['picture']['tmp_name'] : "";
$new_image_name = basename($file_name);
$upload_path = "../../uploads/" . $new_image_name;

if (isset($_POST['add'])) {
	$request->store(new User(
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
		$_POST['role'],
		$new_image_name,
		md5($_POST['cin'])
	));
	move_uploaded_file($file_temp_name, $upload_path);
	header('Location: users.php');
}


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
		<!-- Desktop sidebar -->
		<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
			<div class="py-4 text-gray-500 dark:text-gray-400">
				<a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="publicex.php">
					Navasms
				</a>
				<ul class="mt-6">
					<li class="relative px-6 py-3">
						<a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="../index.php">
							<svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
								<path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
							</svg>
							<span class="ml-4">Dashboard</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="relative px-6 py-3">
						<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
						<a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="../manage-user/">
							<svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
								<path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
							</svg>
							<span class="ml-4">Manage Users</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="relative px-6 py-3">
						<a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="../manage-faculty/">
							<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
							</svg>
							<span class="ml-4">Manage Departments</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="relative px-6 py-3">
						<a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="../manage-class/">
							<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
							</svg>
							<span class="ml-4">Manage Classes</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="relative px-6 py-3">
						<a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="../manage-subject/">
							<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
							</svg>
							<span class="ml-4">Manage Subjects</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="relative px-6 py-3">

						<a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="../manage-student/">
							<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path d="M12 14l9-5-9-5-9 5 9 5z" />
								<path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
							</svg>
							<span class="ml-4">Manage Students</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="relative px-6 py-3">
						<a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="../manage-teachers/">
							<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path d="M12 14l9-5-9-5-9 5 9 5z" />
								<path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
							</svg>
							<span class="ml-4">Manage Teachers</span>
						</a>
					</li>
				</ul>
			</div>
		</aside>
		<!-- Mobile sidebar -->
		<!-- Backdrop -->
		<div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
		<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden" x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu" @keydown.escape="closeSideMenu">
			<div class="py-4 text-gray-500 dark:text-gray-400">
				<a href="publicex.php" class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200">
					Navasms
				</a>
				<ul class="mt-6">
					<li class="relative px-6 py-3">
						<a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="../index.php">
							<svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
								<path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
							</svg>
							<span class="ml-4">Dashboard</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="relative px-6 py-3">
						<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
						<a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="../manage-user/users.php">
							<svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
								<path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
							</svg>
							<span class="ml-4">Manage Users</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="relative px-6 py-3">
						<a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="../manage-faculty/index.php">
							<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
							</svg>
							<span class="ml-4">Manage Departments</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="relative px-6 py-3">
						<a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="../manage-class/index.php">
							<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
							</svg>
							<span class="ml-4">Manage Classes</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="relative px-6 py-3">
						<a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="index.php">
							<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
							</svg>
							<span class="ml-4">Manage Subjects</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="relative px-6 py-3">
						<a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="index.php">
							<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
							</svg>
							<span class="ml-4">Manage Students</span>
						</a>
					</li>
				</ul>
			</div>
		</aside>
		<div class="flex flex-col flex-1">
			<header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
				<div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
					<!-- Mobile hamburger -->
					<button class="p-1 -ml-1 mr-5 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple" @click="toggleSideMenu" aria-label="Menu">
						<svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
							<path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
						</svg>
					</button>
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
								<img class="object-cover w-8 h-8 rounded-full" src="https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=aa3a807e1bbdfd4364d1f449eaa96d82" alt="" aria-hidden="true" />
							</button>
							<template x-if="isProfileMenuOpen">
								<ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu" class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700" aria-label="submenu">
									<li class="flex">
										<a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200" href="#">
											<svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
												<path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
											</svg>
											<span>Profile</span>
										</a>
									</li>
									<li class="flex">
										<a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200" href="#">
											<svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
												<path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
												<path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
											</svg>
											<span>Settings</span>
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
									<input name="first_name" type="text" placeholder="first name..." class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
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
									<input name="last_name" type="text" placeholder="last name..." class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
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
									<input name="email" type="email" placeholder="foulen@foulen.xyz" class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
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
									<input name="cin" type="number" placeholder="national id card..." maxlength="8" minlength="8" class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
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
									<input name="phone_number" type="number" maxlength="8" placeholder="phone number +216..." maxlength="8" minlength="8" class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
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
											<input type="radio" name="gender" required value="MALE" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
											<span class="ml-2">Male</span>
										</label>
									</div>
									<div>
										<label class="inline-flex items-center text-gray-600 dark:text-gray-400">
											<input type="radio" name="gender" required value="FEMALE" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
											<span class="ml-2">Female</span>
										</label>
									</div>
								</div>
							</label>
							<!-- birth date -->
							<label class="block mt-4 text-sm">
								<span class="text-gray-700 dark:text-gray-400">Phone Number</span>
								<div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
									<input name="birth_date" type="date" value="<?php echo date('Y-m-d'); ?>" class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
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
									<input name="address1" type="text" placeholder="location..." class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
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
									<input name="address2" type="text" placeholder="optional..." class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
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
									<input name="state" type="text" placeholder="state..." class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
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
									<input name="city" type="text" placeholder="city..." class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
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
									<input name="postal_code" type="number" placeholder="zip..." minlength="3" class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
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
							<label class="block text-sm">
								<span class="text-gray-700 dark:text-gray-400">
									Account Type
								</span>
								<select multiple name="role" class="overflow-hidden block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
									<option value="STUDENT">Student</option>
									<option value="TEACHER">Teacher</option>
									<option value="ADMINISTRATOR">Administrator</option>
								</select>
							</label>
							<div class="mt-4">
								<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="user_avatar">Upload file</label>
								<input id="user_avatar" name="picture" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" type="file">
								<div class="shrink-0">
									<img id="profile_picture" class="mt-2 h-12 w-12 object-cover rounded-full" src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1361&q=80" alt="Current profile photo" />
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
								<button name="add" class="w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
									Register a User
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