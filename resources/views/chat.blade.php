
<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="app">
	
	
	<example-component :user-data="'{!! Auth::user()->id !!}'"></example-component>

</div>
<script src="{{ asset('public/js/app.js') }}"></script>
<script>

 Echo.private('user.{{ Auth::user()->id }}')
          .listen('NewMessageNotification', (e) => {
              alert(e.message.name);
          });

	</script>