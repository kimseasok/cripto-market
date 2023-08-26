function initCustomPage(){}function initDashboard(t=!1){$(".dash-pan-cry").each((function(){let t=$(this).attr("symbol"),a=$(this).attr("currency"),e=$(this).attr("market");if(addSubscribtion(t,$(this).attr("currency")),"not_init"!=t){let r=$(this).attr("id");loadChart(t,(function(){loadChartData(t,r)}),r,a,e)}})),t||(initManageDashboard(),reloadTopListGraph(),initTopListItemTouch()),$("[dashboard-cfg]").off("click").click((function(){changeDashboardFormat($(this).attr("dashboard-cfg")),setTimeout((function(){hideDashboardManager()}),100)})),$(".dash-add-graph-selected").find('input[type="text"]').off("keyup").keyup((function(){updateListCoinGraph($(this).val(),$(this).attr("graph"),(function(t,a){addGraphDashboard(t,a)}))})),$(".addgraph-dashboard").click((function(){$(".dash-add-graph-selected").css("display","flex"),updateListCoinGraph($(".dash-add-graph-selected").find('input[type="text"]').val(),$(".dash-add-graph-selected").find('input[type="text"]').attr("graph"),(function(t,a){addGraphDashboard(t,a)}))})),subscribeStreamerCallback((function(t){if(isNaN(t.CHANGE24HOURPCT))return!1;$('.top-graphlist-item[symbol="'+t.FROMSYMBOL+'"]').find('[data="CHANGE24HOURPCT"]').html(t.CHANGE24HOURPCT+"%"),$('.top-graphlist-item[symbol="'+t.FROMSYMBOL+'"]').attr("val-graph",t.PRICE),$('.top-graphlist-item[symbol="'+t.FROMSYMBOL+'"]').find('[data="CHANGE24HOURPCT"]').removeClass("top-graphlist-item-evl-up").removeClass("top-graphlist-item-evl-down"),parseFloat(t.CHANGE24HOURPCT)<0?$('.top-graphlist-item[symbol="'+t.FROMSYMBOL+'"]').find('[data="CHANGE24HOURPCT"]').addClass("top-graphlist-item-evl-down"):parseFloat(t.CHANGE24HOURPCT)>0&&$('.top-graphlist-item[symbol="'+t.FROMSYMBOL+'"]').find('[data="CHANGE24HOURPCT"]').addClass("top-graphlist-item-evl-up")})),$(window).resize((function(){checkGraphResize()}))}function addTopListDashboardSearchPop(t,a,e){addGraphDashboard({symbol:t,currency:a,market:e},a,e),setTimeout((function(){closeBigSearch()}),100)}function addGraphDashboard(t,a,e){addTopListGraph(t,(function(t){t.trigger("click")})),addSubscribtion(t.symbol,a),setTimeout((function(){$(".dash-pan-cry-select").hide()}),100)}function addGraphDashboardNotInit(t,a,e){addGraphDashboard({symbol:t,currency:a,market:e},a,e),closeBigSearch()}function reloadTopListGraph(){$(".top-graphlist-item").each((function(){$(this).find(".top-graphlist-closeb").off("click").click((function(t){if($(this).parent().attr("container").length>0&&$('.dash-pan-cry[container="'+$(this).parent().attr("container")+'"]').length>0)removeGraph($(this).parent().attr("container"));else{let t=$(this).parent().attr("topitem");$(this).parent().remove(),$.post($("body").attr("hrefapp")+"/app/modules/dashboard/src/actions/deleteTopList.php",{topitem:t}).done((function(t){let a=jQuery.parseJSON(t);1==a.error&&showAlert("Oops",a.msg,"error")})).fail((function(){showAlert("Oops","Fail to access to top list delete action (404, 505)","error")}))}return t.preventDefault(),!1})),$(this).off("click").click((function(){$('[module="dashboard"][view="dashboard"].leftnav-select').length>0?$('[view="dashboard"]').hasClass("leftnav-select")?changeTopItemAction($(this)):changeView("dashboard","dashboard",{},changeTopItemAction($(this))):changeView("coin","coin",{symbol:$(this).attr("symbol"),currency:$(this).attr("currency"),market:$(this).attr("market")})})),addSubscribtion($(this).attr("symbol"),$(this).attr("currency")),0==$('.dash-pan-cry[container="'+$(this).attr("container")+'"][symbol="'+$(this).attr("symbol")+'"][currency="'+$(this).attr("currency")+'"][market="'+$(this).attr("market")+'"]').length?$(this).removeClass("top-graphlist-item-view"):$(this).addClass("top-graphlist-item-view")}))}function changeSelectedTopList(t,a,e,r="CCCAGG"){$(".top-graphlist-item").removeClass("top-graphlist-item-selected"),$('.top-graphlist-item[container="'+t+'"][symbol="'+a+'"][currency="'+e+'"][market="'+r+'"]').addClass("top-graphlist-item-selected"),loadLeftInfosCoin(a,e,r)}function checkGraphResize(){$(".dash-pan-cry").each((function(){null!=chartList[$(this).attr("id")]&&chartList[$(this).attr("id")].graph.resize("100%","100%")}))}function changeDashboardFormat(t){changeView("dashboard","dashboard",{nchart:t})}function addTopListGraph(t,a=null){$.post($("body").attr("hrefapp")+"/app/modules/dashboard/src/actions/addTopList.php",{symbol:t.symbol,currency:t.currency,market:t.market}).done((function(t){let e=jQuery.parseJSON(t);if(0==e.error){let t=$('<li class="mono top-graphlist-item" container="" topitem="'+e.item_id+'" symbol="'+e.coin_infos.symbol+'" coinname="'+e.coin_infos.name+'" currency="'+e.coin_infos.currency+'" market="'+e.coin_infos.market+'" pasth="" val-graph=""><div class="top-graphlist-closeb"><i class="gw fa-light fa-xmark"></i></div>'+(null!=e.coin_infos.icon?'<div class="top-graphlist-pic">'+e.coin_infos.icon+"</div>":"")+'<img class="symbol" src="/assets/img/icons/crypto/'+e.coin_infos.symbol.toLowerCase()+'.svg" width="24" height="24"/><img class="currency hover" src="/assets/img/icons/crypto/'+e.coin_infos.currency.toLowerCase()+'.svg" width="24" height="24"/><div class="top-graphlist-inf"><label>'+e.coin_infos.symbol+"/"+e.coin_infos.currency+'</label><span data="CHANGE24HOURPCT">~</span></div></li>');$(".top-graphlist").append(t),reloadTopListGraph(),null!=a&&a(t)}else showAlert("Oops",e.msg,"error")})).fail((function(){showAlert("Oops","Fail create new top item (404, 505)","error")}))}let curXPos=0,curDown=!1;function initTopListItemTouch(){$("ul.top-graphlist").off("mousemove").on("mousemove",(function(t){if(!curDown)return!1;$("ul.top-graphlist").scrollLeft(parseInt($("ul.top-graphlist").scrollLeft()+(curXPos-t.pageX))),curXPos=t.pageX})),$("ul.top-graphlist").off("mousedown").on("mousedown",(function(t){curDown=!0,curXPos=t.pageX,t.preventDefault()})),$(window).off("mouseup").on("mouseup",(function(t){curDown=!1}))}function changeTopItemAction(t){if(t.hasClass("top-graphlist-item-view")){if(t.hasClass("top-graphlist-item-selected")){let a=$('.dash-pan-cry[container="'+t.attr("container")+'"][symbol="'+t.attr("symbol")+'"][currency="'+t.attr("currency")+'"][market="'+t.attr("market")+'"]');a.removeClass("animated").removeClass("bounceIn"),setTimeout((function(){a.addClass("animated").addClass("bounceIn")}),100)}else loadLeftInfosCoin(t.attr("symbol"),t.attr("currency"),t.attr("market"));$(".top-graphlist-item-selected").removeClass("top-graphlist-item-selected"),t.addClass("top-graphlist-item-selected")}else{let a=$(".dash-pan-cry").first();$(".dash-pan-cry-selected").length>0&&(a=$(".dash-pan-cry-selected")),$('.dash-pan-cry[chart-init="false"]').length>0&&(a=$('.dash-pan-cry[chart-init="false"]').first()),loadLeftInfosCoin(t.attr("symbol"),t.attr("currency"),t.attr("market"));let e=a.attr("id");a.attr("symbol",$(this).attr("symbol")),a.attr("currency",$(this).attr("currency")),a.attr("market",$(this).attr("market")),$('.top-graphlist-item[container="'+a.attr("id")+'"]').attr("container",""),t.attr("container",e),changeGraph({icon:t.find(".top-graphlist-pic").html(),name:t.attr("coinname"),symbol:t.attr("symbol")},t.attr("currency"),e,t.attr("topitem"),!1,t.attr("market"))}$(".dash-pan-cry-selected").removeClass("dash-pan-cry-selected"),$('.dash-pan-cry[container="'+t.attr("container")+'"]').addClass("dash-pan-cry-selected")}