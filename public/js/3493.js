"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[3493],{3493:(t,e,n)=>{n.r(e),n.d(e,{default:()=>o});const i={props:[],components:{},data:function(){return{account:{},windowHeight:.88*window.innerHeight,windowWidth:.955*window.innerWidth,txt:""}},methods:{goBack:function(){window.history.length>1?this.$router.go(-1):this.$router.push("/")},fetchData:function(){var t=this;this.$http.post("/user/fetch/forex").then((function(e){t.account=e.data.account}))},onResize:function(){this.windowHeight=.88*window.innerHeight,this.windowWidth=.955*window.innerWidth}},created:function(){this.fetchData()},mounted:function(){var t=this;this.$nextTick((function(){window.addEventListener("resize",t.onResize)}))},beforeDestroy:function(){window.removeEventListener("resize",this.onResize)},destroyed:function(){}};const o=(0,n(1900).Z)(i,(function(){var t=this,e=t.$createElement;return(t._self._c||e)("iframe",{style:"height:"+t.windowHeight+"px;width:"+t.windowWidth+"px;margin:-27px",attrs:{src:"https://trade.mql5.com/trade?servers="+t.account.broker+"&trade_server="+t.account.broker+"&demo_all_servers&=1&startup_mode=open_trade&lang="+t.account.language+"&save_password=on&login="+t.account.number,allowfullscreen:"allowfullscreen"}})}),[],!1,null,null,null).exports}}]);