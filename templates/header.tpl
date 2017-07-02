<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Sosmol CMS site">
		<meta name="author" content="Phil Jauvin">
		<title>{Settings::Get()->Value(['site', 'title'])}</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans|Zilla+Slab" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="/templates/css/style.css">
		<![endif]-->
	</head>
	<body>

		<nav class="main-navbar">
      <ul>
        <a href="/"><li>Home</li></a>
        <a href="/about"><li>About</li></a>
      </ul>
    </nav>

		<aside class="frontpage-sidebar">

			<section>
				<header>Recent posts</header>
				<span>Article 1</span>
				<span>Article 2</span>
			</section>

			<section>
				<header>Categories</header>
				<span>Category 1</span>
				<span>Category 2</span>
			</section>

			<section>
				<img src="/templates/img/chihuahua.jpg">
			</section>

		</aside>

		<main class="content-view">
