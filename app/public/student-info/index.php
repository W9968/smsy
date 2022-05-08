<?php

require_once "../../../vendor/autoload.php";

use App\controllers\StudentController;


session_start();
if ($_SESSION['loggedIn'] == "false") {
	header("Location: ./auth/");
}

if ($_SESSION['role'] != 'STUDENT') {
	header("Location: ../404.html");
}


$payload = new StudentController('', '');
$loggedInUser = $payload->findStudentProfile($_SESSION['uuid']);

$assgined_classes = $payload->getClasses($loggedInUser['class_id']);

?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Dashboard</title>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="../assets/css/tailwind.output.css" />
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
	<script src="../assets/js/init-alpine.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
	<script src="../assets/js/charts-lines.js" defer></script>
	<script src="../assets/js/charts-pie.js" defer></script>
</head>

<body>
	<div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
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
								<img class="object-cover w-8 h-8 rounded-full" src="../../uploads/<?php echo $loggedInUser['profile_picture'] ?>" alt="profile picture" aria-hidden="true" />
							</button>
							<template x-if="isProfileMenuOpen">
								<ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu" class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700" aria-label="submenu">
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
			<main class="h-full overflow-y-auto">
				<div class="container px-6 mx-auto grid pt-10">
					<h1 class="mb-4 text-2xl font-semibold capitalize text-gray-700 dark:text-gray-200">Basic Information</h1>
					<div class="w-full overflow-hidden mt-8 rounded-lg shadow-xs mb-2">
						<div class="w-full overflow-x-auto ">
							<table class="w-full whitespace-no-wrap">
								<thead>
									<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
										<th class="px-4 py-3">Picture</th>
										<th class="px-4 py-3">Full Nom</th>
										<th class="px-4 py-3">Email</th>
										<th class="px-4 py-3">Phone</th>
										<th class="px-4 py-3">Birth</th>
										<th class="px-4 py-3">Payment</th>
									</tr>
								</thead>
								<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
									<tr class="text-gray-700 dark:text-gray-400">
										<td class="px-4 py-3">
											<div class="flex items-center text-sm">
												<img class="object-cover w-8 h-8 rounded-full" src="../../uploads/<?php echo $loggedInUser['profile_picture'] ?>" />
											</div>
										</td>
										<td class="px-4 py-3">
											<div class="flex items-center text-sm">
												<span><?php echo $loggedInUser['first_name'] . " " . $loggedInUser['last_name'] ?></span>
											</div>
										</td>
										<td class="px-4 py-3">
											<div class="flex items-center text-sm">
												<span><?php echo $loggedInUser['cin'] ?></span>
											</div>
										</td>
										<td class="px-4 py-3">
											<div class="flex items-center text-sm">
												<span><?php echo $loggedInUser['phone'] ?></span>
											</div>
										</td>
										<td class="px-4 py-3">
											<div class="flex items-center text-sm">
												<span><?php echo $loggedInUser['birth'] ?></span>
											</div>
										</td>
										<td class="px-4 py-3">
											<div class="flex items-center text-sm">
												<span><?php echo $loggedInUser['paied'] ?></span>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="w-full overflow-hidden mt-8 rounded-lg shadow-xs mb-6">
						<div class="w-full overflow-x-auto ">
							<table class="w-full whitespace-no-wrap">
								<thead>
									<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
										<th class="px-4 py-3">Adress 1</th>
										<th class="px-4 py-3">Adress 2</th>
										<th class="px-4 py-3">City</th>
										<th class="px-4 py-3">State</th>
										<th class="px-4 py-3">Registred</th>
										<th class="px-4 py-3">Classe</th>
										<th class="px-4 py-3">Department</th>
									</tr>
								</thead>
								<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
									<tr class="text-gray-700 dark:text-gray-400">
										<td class="px-4 py-3">
											<div class="flex items-center text-sm">
												<span><?php echo $loggedInUser['adress1'] ?></span>
											</div>
										</td>
										<td class="px-4 py-3">
											<div class="flex items-center text-sm">
												<span><?php if ($loggedInUser['adress2']) echo $loggedInUser['adress2'];
														else echo 'N/A'   ?></span>
											</div>
										</td>
										<td class="px-4 py-3">
											<div class="flex items-center text-sm">
												<span><?php echo $loggedInUser['city'] ?></span>
											</div>
										</td>
										<td class="px-4 py-3">
											<div class="flex items-center text-sm">
												<span><?php echo $loggedInUser['state'] ?></span>
											</div>
										</td>
										<td class="px-4 py-3">
											<div class="flex items-center text-sm">
												<span><?php echo $loggedInUser['enrolled'] ?></span>
											</div>
										</td>
										<td class="px-4 py-3">
											<div class="flex items-center text-sm">
												<span><?php echo $loggedInUser['class_name'] . $loggedInUser['class_level'] ?></span>
											</div>
										</td>
										<td class="px-4 py-3">
											<div class="flex items-center text-sm">
												<span><?php echo $loggedInUser['dep_id'] ?></span>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<h1 class="mt-4 mb-2 text-2xl font-semibold capitalize text-gray-700 dark:text-gray-200">Courses Timing</h1>
					<div class="w-full overflow-hidden mt-8 rounded-lg shadow-xs">
						<div class="w-full overflow-x-auto">
							<table class="w-full whitespace-no-wrap">
								<thead>
									<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
										<th class="px-4 py-3">Subject</th>
										<th class="px-4 py-3">Period</th>
									</tr>
								</thead>
								<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
									<?php
									foreach ($assgined_classes as $taw9it) {
									?>
										<tr class="text-gray-700 dark:text-gray-400">
											<td class="px-4 py-3">
												<div class="flex items-center text-sm">
													<span><?php echo $taw9it['subject_id'] ?></span>
												</div>
											</td>
											<td class="px-4 py-3">
												<div class="flex items-center text-sm">
													<span><?php echo $taw9it['begin_period'] ?></span>
												</div>
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