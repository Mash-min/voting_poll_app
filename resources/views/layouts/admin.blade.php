<html>
	<head>
		<title>Admin Panel</title>
        <link rel="stylesheet" href="/css/materialize.min.css">
        <link rel="stylesheet" href="/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/index.css">
	</head>
	<body>
	<ul id="slide-out" class="side-nav fixed">
		<li class="bold"><a href="{{ route('index') }}" class="waves-effect waves-light">Home</a></li>
		<!-- <li class="bold"><a href="{{ route('dashboard') }}" class="waves-effect waves-light">Dashboard</a></li> -->
		<li class="no-padding">
			<ul class="collapsible collapsible-accordion">
				<li class="bold"><a class="collapsible-header waves-effect waves-light active">Questions</a>
					<div class="collapsible-body">
						<ul>
							<li><a href="{{ route('question_add') }}"><i class="fa fa-chevron-right"></i> Add Question</a></li>
							<li><a href="{{ route('question_list') }}"><i class="fa fa-chevron-right"></i> Question list</a></li>
							<li><a href="{{ route('question_archive') }}"><i class="fa fa-chevron-right"></i> Archive</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</li>
    </ul><!-- sidenav -->
   
    <div class="body-container">
    	<nav class="cyan darken-1">
		    <div class="nav-wrapper container">
		      <a href="#" data-activates="slide-out" class="button-collapse">
				  <i class="fa fa-bars"></i>
			  </a>
		    </div>
		  </nav>

		  <div class="row body-components-container">
		  	@yield('content')
		  </div><!-- body-components-container -->
    </div>

	</body>
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/materialize.min.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    <script src="/js/index.js"></script>
    @yield('scripts')
</html>