<?php

require_once "../../vendor/autoload.php";

use App\controllers\UserController;


session_start();
if (empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == "false") {
	header("Location: ./auth/");
}

if ($_SESSION['loggedIn'] == "true") {
	if ($_SESSION['role'] != 'ADMINISTRATOR') {
		header("Location: 404.html");
	}
}

$payload = new UserController('', '');
$users = $payload->findMany()->fetchAll();
$count = $payload->findMany()->rowCount();

$revenue = $payload->Revenue();

$loggedUser = $payload->findOne($_SESSION['uuid']);


if (isset($_POST['logout'])) {
	$payload->logout();
	header("Location: ./auth/");
}


?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Dashboard</title>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="assets/css/tailwind.output.css" />
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
	<script src="assets/js/init-alpine.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
	<script src="assets/js/charts-lines.js" defer></script>
	<script src="assets/js/charts-pie.js" defer></script>
</head>

<body>
	<div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
		<!-- Desktop sidebar -->
		<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
			<div class="py-4 text-gray-500 dark:text-gray-400">
				<a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="publicex.php">
					Navasms
				</a>
				<ul class="mt-6">
					<li class="relative px-6 py-3">
						<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
						<a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="index.php">
							<svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
								<path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
							</svg>
							<span class="ml-4">Dashboard</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="relative px-6 py-3">
						<a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="./manage-user/">
							<svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
								<path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
							</svg>
							<span class="ml-4">Manage Users</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="relative px-6 py-3">
						<a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="./manage-faculty/">
							<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
							</svg>
							<span class="ml-4">Manage Departments</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="relative px-6 py-3">
						<a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="./manage-class/index.php">
							<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
							</svg>
							<span class="ml-4">Manage Classes</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="relative px-6 py-3">
						<a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="./manage-subject/">
							<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
							</svg>
							<span class="ml-4">Manage Subjects</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="relative px-6 py-3">

						<a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="./manage-student/">
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
						<a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="./manage-teachers/">
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
						<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
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
		<div class="flex flex-col flex-1 w-full">
			<header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
				<div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
					<!-- Mobile hamburger -->
					<button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple" @click="toggleSideMenu" aria-label="Menu">
						<svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
							<path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
						</svg>
					</button>
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
								<img class="object-cover w-8 h-8 rounded-full" src="../uploads/<?php echo $loggedUser['profile_picture'] ?>" alt="" aria-hidden="true" />
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

										<a href="./auth/logout.php" class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200">
											<svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
												<path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
											</svg>
											<span> Log out </span>
										</a>

									</li>
								</ul>
							</template>
						</li>
					</ul>
				</div>
			</header>
			<main class="h-full overflow-y-auto">
				<div class="container px-6 mx-auto grid">
					<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
						Dashboard
					</h2>
					<!-- Cards -->
					<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
						<!-- Card -->
						<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
							<div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
								<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
									<path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
								</svg>
							</div>
							<div>
								<p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
									Total users
								</p>
								<p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
									<?php echo $count ?>
								</p>
							</div>
						</div>
						<!-- Card -->
						<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
							<div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
								<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
								</svg>
							</div>
							<div>
								<p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
									Student Fees
								</p>
								<p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
									$ <?php echo $revenue[0] ?>
								</p>
							</div>
						</div>
						<!-- Card -->
						<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
							<div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
								<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
								</svg>
							</div>
							<div>
								<p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
									Teacher Costs
								</p>
								<p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
									$ <?php echo $revenue[1] ?>
								</p>
							</div>
						</div>
						<!-- Card -->
						<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
							<div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
								<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
								</svg>
							</div>
							<div>
								<p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
									Revenue
								</p>
								<p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
									$ <?php if (($revenue[0] - $revenue[1]) > 0) echo $revenue[0] - $revenue[1];
										else  echo - ($revenue[1] - $revenue[0])   ?>
								</p>
							</div>
						</div>
					</div>

					<!-- New Table -->
					<div class="w-full overflow-hidden rounded-lg shadow-xs">
						<div class="w-full overflow-x-auto">
							<table class="w-full whitespace-no-wrap">
								<thead>
									<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
										<th class="px-4 py-3">User</th>
										<th class="px-4 py-3">Id</th>
										<th class="px-4 py-3">Email</th>
										<th class="px-4 py-3">Status</th>
										<th class="px-4 py-3">Birth</th>
										<th class="px-4 py-3">Gender</th>
									</tr>
								</thead>
								<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
									<?php
									foreach ($users as $user) {
									?>
										<tr class="text-gray-700 dark:text-gray-400">

											<td class="px-4 py-3">
												<div class="flex items-center text-sm">
													<!-- Avatar with inset shadow -->
													<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
														<img class="object-cover w-full h-full rounded-full" src="../uploads/<?php echo $user['profile_picture'] ?>" alt="profile-picture" loading="lazy" />
														<div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
													</div>
													<div>
														<p class="font-semibold"><?php echo $user['first_name'] . " " . $user['last_name'] ?></p>
														<p class="text-xs text-gray-600 dark:text-gray-400;">
															<?php echo $user['role'] ?>
														</p>
													</div>
												</div>
											</td>
											<td class="px-4 py-3 text-sm">
												<?php echo $user['cin'] ?>
											</td>
											<td class="px-4 py-3 text-sm">
												<?php echo $user['email'] ?>
											</td>
											<td class="px-4 py-3 text-xs">
												<?php
												if ($user['restriction']) {
												?>
													<span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
														Denied
													</span>
												<?php } else { ?>
													<span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
														Approved
													</span>
												<?php } ?>
											</td>
											<td class="px-4 py-3 text-sm">
												<?php echo $user['birth'] ?>
											</td>
											<td class="px-4 py-3 text-sm">
												<?php echo $user['gender'] ?>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
</body>

</html>