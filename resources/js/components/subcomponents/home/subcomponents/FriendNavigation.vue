<template>
	<li class="list-group-item d-flex align-items-center">
	  	<img src="images/friendship.png" alt="marketplace" width="19px" height="19px">
	  	<span class="ml-1 d-none d-lg-block">Friends</span>  

	  	<span v-if="countValue" class="badge ml-auto bg-primary">{{ friendRequestCountValue }}</span>
	</li>
</template>

<script>
export default {
	name: 'FriendNavigation',

	data(){
		return{
			friendRequestCountValue: 0
		}
	},

	created(){
		this.friendRequestCount()
	},

	mounted(){    
		console.log(process.env.MIX_PUSHER_APP_CLUSTER)
		console.log(process.env.MIX_PUSHER_APP_KEY)
		window.Echo.private('friendRequest.'+this.user.id)
			.listen('.NewFriendRequest', (e) => {
				console.log('hello')
				console.log(e.friendRequest);
				this.setFriendRequestCountValue(1)
			});
	},

	methods: {
		friendRequestCount(){
			axios.get('/api/friends/request-count')
			.then(res => {
				this.setFriendRequestCountValue(res.data)
			})
			.catch(err => {
				console.log('FriendNavigation Component, method: friendRequestCount' + err)
			})
		},
		setFriendRequestCountValue(value){
			// Set value to count, if count is greater to 99 set to string = "99+"
			this.friendRequestCountValue += value
			if(this.friendRequestCountValue > 99){
				this.friendRequestCountValue = "99+"
			}
		}
	},

	computed:{
		countValue(){
			return (this.friendRequestCountValue != 0) ? true : false
		},
		user(){
			return this.$store.getters['auth/user']
		}
	}
}
</script>