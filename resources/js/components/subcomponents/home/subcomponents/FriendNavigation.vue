<template>
	<router-link :to="{name:'friends'}" class="list-group-item anchorUnstyled">
		<li class="d-flex align-items-center">
			<img src="/images/friendship.png" alt="marketplace" width="19px" height="19px">
			<span class="ml-1 d-none d-lg-block">Friends</span>  

			<span v-if="countValueChecker" class="badge ml-auto bg-secondary">{{ countValue }}</span>
		</li>
	</router-link>
</template>

<script>
export default {
	name: 'FriendNavigation',

	created(){
		this.friendRequestCount()
	},

	mounted(){    
		Echo.private('friendRequest.'+this.user.id)
			.listen('NewFriendRequest', (e) => {
				// console.log(e.friendRequest);
				this.setFriendRequestCountValue()
			});
	},

	methods: {
		friendRequestCount(){
			this.$store.dispatch('friends/fetchFriendReceivedRequestCount')
		},
		setFriendRequestCountValue(){
			// Add + 1 to count if request recieved realtime
			// If count is greater than 99, set value to string = "99+"
			this.$store.commit('friends/SET_FRIEND_REQUEST_COUNT', this.countValue+1)

			if(this.countValue > 99){
				this.$store.commit('SET_FRIEND_REQUEST_COUNT', "99+")
			}
		}
	},

	computed:{
		countValueChecker(){
			/// Display counter badge in UI if count > 0
			return (this.$store.getters['friends/friendRecievedRequestCount'] != 0) ? true :false
		},
		countValue(){
			return this.$store.getters['friends/friendRecievedRequestCount']
		},
		user(){
			return this.$store.getters['auth/user']
		}
	}
}
</script>

<style lang="scss" scoped>
@media (max-width: 768.98px) {
	.list-group-item {
		& > li {
        	justify-content: center;
    	}
	}
}
</style>