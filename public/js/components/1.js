(window.webpackJsonp=window.webpackJsonp||[]).push([[1],{34:function(e,t,n){"use strict";var i=n(8);n.n(i).a},35:function(e,t,n){(e.exports=n(2)(!1)).push([e.i,".friendRecieverName[data-v-c418f4c6] {\n  font-weight: 600;\n  font-size: 14px;\n  max-width: 200px;\n  white-space: nowrap;\n  overflow: hidden;\n  text-overflow: ellipsis;\n}\n@media (min-width: 768px) {\n.friendRecieverName[data-v-c418f4c6] {\n    width: 250px;\n}\n}\n.friendItem[data-v-c418f4c6] {\n  border-radius: 4px;\n}\n.friendItemImg[data-v-c418f4c6] {\n  border-radius: 50px;\n  width: 30px;\n  height: 30px;\n  box-shadow: 0 0 0 0.2px lightgray;\n}\n.friendItem .fa-user-plus[data-v-c418f4c6] {\n  color: #28B463;\n}\n.friendItem .fa-user-times[data-v-c418f4c6] {\n  color: #EC7063;\n}\n.friendItem .fa-times[data-v-c418f4c6] {\n  color: #ebeb6a;\n}",""])},8:function(e,t,n){var i=n(35);"string"==typeof i&&(i=[[e.i,i,""]]);var r={hmr:!0,transform:void 0,insertInto:void 0};n(3)(i,r);i.locals&&(e.exports=i.locals)},91:function(e,t,n){"use strict";n.r(t);var i={name:"FriendItem",components:{PleaseWaitLoader:n(1).a},props:["friend"],data:function(){return{loading:!1}},methods:{unfriend:function(e){this.loading=!0,this.$store.dispatch("friends/deleteFriend",e)}},computed:{friendData:function(){return this.friend.sender.id==this.$store.getters["auth/user"].id?this.friend.receiver:this.friend.sender}}},r=(n(34),n(0)),s={name:"FriendList",components:{FriendItem:Object(r.a)(i,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"d-flex align-items-center shadow-sm py-2 friendItem bg-white px-2"},[n("div",{staticClass:"friendItemImg centerImage mr-1"},[n("img",{attrs:{src:"/images/user.png",alt:e.friendData.name}})]),e._v(" "),n("router-link",{staticClass:"friendRecieverName anchorColor",attrs:{to:{name:"userProfile",query:{user:e.friendData.id}}}},[e._v(e._s(e.friendData.name))]),e._v(" "),e.loading?e._e():n("div",{staticClass:"dropdown dropleft ml-auto"},[e._m(0),e._v(" "),n("div",{staticClass:"dropdown-menu",attrs:{"aria-labelledby":"friendOptions"}},[n("router-link",{staticClass:"dropdown-item",attrs:{to:{name:"userProfile",query:{user:e.friendData.id}}}},[e._v("View Profile")]),e._v(" "),n("router-link",{staticClass:"dropdown-item",attrs:{to:{name:"message",query:{user:e.friendData.id}}}},[e._v("Send Message")]),e._v(" "),n("div",{staticClass:"dropdown-divider"}),e._v(" "),n("button",{staticClass:"emptyBtn dropdown-item"},[e._v(" Block ")]),e._v(" "),n("button",{staticClass:"emptyBtn dropdown-item",on:{click:function(t){return e.unfriend(e.friend)}}},[e._v(" Unfriend ")])],1)]),e._v(" "),e.loading?n("PleaseWaitLoader",{staticClass:"ml-auto"}):e._e()],1)}),[function(){var e=this.$createElement,t=this._self._c||e;return t("button",{staticClass:"emptyBtn mr-1 px-1",attrs:{type:"button",id:"friendOptions","data-toggle":"dropdown","aria-haspopup":"true","aria-expanded":"false"}},[t("i",{staticClass:"fas fa-ellipsis-v"})])}],!1,null,"c418f4c6",null).exports},created:function(){this.fetchFriends()},methods:{fetchFriends:function(){this.$store.dispatch("friends/fetchFriends")}},computed:{friends:function(){return this.$store.getters["friends/friends"]}}},a=Object(r.a)(s,(function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"container-fluid py-2 px-3"},[t("div",{staticClass:"row no-gutters"},this._l(this.friends.data,(function(e){return t("div",{key:e.id,staticClass:"col-12 col-md-6 mb-2"},[t("div",{staticClass:"mr-md-2"},[t("FriendItem",{attrs:{friend:e}})],1)])})),0)])}),[],!1,null,null,null);t.default=a.exports}}]);