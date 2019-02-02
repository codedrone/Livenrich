!function(t,e,i,a){function o(t){var e=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(t);return e?{r:parseInt(e[1],16),g:parseInt(e[2],16),b:parseInt(e[3],16)}:{r:0,g:0,b:0}}t.image_map_pro_editor_content=function(){var e=t.image_map_pro_editor_current_settings(),i="";"zoom-in"==e.editor.tool&&(i+='<div class="imp-editor-canvas-overlay" id="imp-editor-canvas-overlay-zoom-in"></div>'),"zoom-out"==e.editor.tool&&(i+='<div class="imp-editor-canvas-overlay" id="imp-editor-canvas-overlay-zoom-out"></div>'),("drag"==e.editor.tool||e.editor.state.dragging)&&(i+='<div class="imp-editor-canvas-overlay" id="imp-editor-canvas-overlay-drag"></div>'),i+='<img id="imp-editor-image" src="'+e.image.url+'">',i+='<div id="imp-editor-shapes-container">';for(var a=0;a<e.spots.length;a++){var d=e.spots[a];if("spot"==d.type)if(1==parseInt(d.default_style.use_icon,10)){p="";p+="left: "+d.x+"%;",p+="top: "+d.y+"%;",p+="width: "+d.width+"px;",p+="height: "+d.height+"px;",p+="margin-left: -"+d.width/2+"px;",p+="margin-top: -"+d.height/2+"px;",p+="background-image: url("+d.default_style.icon_url+")",p+="background-position: center;",p+="background-repeat: no-repeat;";var s="";if(1==parseInt(d.default_style.icon_is_pin,10)&&(s+="top: -50%;",s+="position: absolute;"),i+='<div class="imp-editor-shape imp-editor-spot" data-id="'+d.id+'" data-editor-object-type="1" style="'+p+'"><div class="imp-selection" style="border-radius: '+d.default_style.border_radius+'px;"></div>',"library"==d.default_style.icon_type?(i+='   <svg style="'+s+'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="'+d.default_style.icon_svg_viewbox+'" xml:space="preserve" width="'+d.width+'px" height="'+d.height+'px">',i+='       <path style="fill:'+d.default_style.icon_fill+'" d="'+d.default_style.icon_svg_path+'"></path>',i+="   </svg>"):d.default_style.icon_url.length>0&&(i+='<img style="'+s+'" src="'+d.default_style.icon_url+'">'),1==parseInt(d.default_style.icon_shadow,10)){var r="";r+="width: "+d.width+"px;",r+="height: "+d.height+"px;",0==parseInt(d.default_style.icon_is_pin,10)&&(r+="top: "+d.height/2+"px;"),i+='<div style="'+r+'" class="imp-editor-shape-icon-shadow"></div>'}i+="</div>"}else{var l=o(d.default_style.background_color),n=o(d.default_style.border_color),p="";p+="left: "+d.x+"%;",p+="top: "+d.y+"%;",p+="width: "+d.width+"px;",p+="height: "+d.height+"px;",p+="margin-left: -"+d.width/2+"px;",p+="margin-top: -"+d.height/2+"px;",p+="background: rgba("+l.r+", "+l.g+", "+l.b+", "+d.default_style.background_opacity+");",p+="border-color: rgba("+n.r+", "+n.g+", "+n.b+", "+d.default_style.border_opacity+");",p+="border-width: "+d.default_style.border_width+"px;",p+="border-style: "+d.default_style.border_style+";",p+="border-radius: "+d.default_style.border_radius+"px;",i+='<div class="imp-editor-shape imp-editor-spot" data-id="'+d.id+'" data-editor-object-type="1" style="'+p+'"><div class="imp-selection" style="border-radius: '+d.default_style.border_radius+'px;"></div></div>'}if("rect"==d.type){var l=o(d.default_style.background_color),n=o(d.default_style.border_color),p="";p+="left: "+d.x+"%;",p+="top: "+d.y+"%;",p+="width: "+d.width+"%;",p+="height: "+d.height+"%;",p+="background: rgba("+l.r+", "+l.g+", "+l.b+", "+d.default_style.background_opacity+");",p+="border-color: rgba("+n.r+", "+n.g+", "+n.b+", "+d.default_style.border_opacity+");",p+="border-width: "+d.default_style.border_width+"px;",p+="border-style: "+d.default_style.border_style+";",p+="border-radius: "+d.default_style.border_radius+"px;",i+='<div class="imp-editor-shape imp-editor-rect" data-id="'+d.id+'" data-editor-object-type="3" style="'+p+'">',i+='   <div class="imp-selection" style="border-radius: '+d.default_style.border_radius+'px;">',i+='       <div class="imp-selection-translate-boxes">',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-1" data-transform-direction="1" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-2" data-transform-direction="2" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-3" data-transform-direction="3" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-4" data-transform-direction="4" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-5" data-transform-direction="5" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-6" data-transform-direction="6" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-7" data-transform-direction="7" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-8" data-transform-direction="8" data-editor-object-type="5"></div>',i+="       </div>",i+="   </div>",i+="</div>"}if("oval"==d.type){var l=o(d.default_style.background_color),n=o(d.default_style.border_color),p="";p+="left: "+d.x+"%;",p+="top: "+d.y+"%;",p+="width: "+d.width+"%;",p+="height: "+d.height+"%;",p+="background: rgba("+l.r+", "+l.g+", "+l.b+", "+d.default_style.background_opacity+");",p+="border-color: rgba("+n.r+", "+n.g+", "+n.b+", "+d.default_style.border_opacity+");",p+="border-width: "+d.default_style.border_width+"px;",p+="border-style: "+d.default_style.border_style+";",p+="border-radius: 100% 100%;",i+='<div class="imp-editor-shape imp-editor-oval" data-id="'+d.id+'" data-editor-object-type="2" style="'+p+'">',i+='   <div class="imp-selection" style="border-radius: 100% 100%;">',i+='       <div class="imp-selection-translate-boxes">',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-1" data-transform-direction="1" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-2" data-transform-direction="2" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-3" data-transform-direction="3" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-4" data-transform-direction="4" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-5" data-transform-direction="5" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-6" data-transform-direction="6" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-7" data-transform-direction="7" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-8" data-transform-direction="8" data-editor-object-type="5"></div>',i+="       </div>",i+="   </div>",i+="</div>"}if("poly"==d.type&&d.points){var c=o(d.default_style.fill),b=o(d.default_style.stroke_color),p="";p+="left: "+d.x+"%;",p+="top: "+d.y+"%;",p+="width: "+d.width+"%;",p+="height: "+d.height+"%;";var y="";y+="width: 100%;",y+="height: 100%;",y+="fill: rgba("+c.r+", "+c.g+", "+c.b+", "+d.default_style.fill_opacity+");",y+="stroke: rgba("+b.r+", "+b.g+", "+b.b+", "+d.default_style.stroke_opacity+");",y+="stroke-width: "+d.default_style.stroke_width+"px;",y+="stroke-dasharray: "+d.default_style.stroke_dasharray+";",y+="stroke-linecap: "+d.default_style.stroke_linecap+";",i+='<div class="imp-editor-shape imp-editor-poly" data-id="'+d.id+'" data-editor-object-type="4" style="'+p+'">',i+='   <div class="imp-editor-poly-svg-temp-control-point" data-editor-object-type="6"></div>';var v=e.general.width*(d.width/100),m=e.general.height*(d.height/100);i+='   <div class="imp-editor-svg-wrap" style="padding: '+d.default_style.stroke_width+"px; left: -"+d.default_style.stroke_width+"px; top: -"+d.default_style.stroke_width+'px;">',i+='       <svg class="imp-editor-poly-svg" viewBox="0 0 '+v+" "+m+'" preserveAspectRatio="none" style="'+y+'">',i+='           <polygon points="';for(h=0;h<d.points.length;h++)i+=(_=d.default_style.stroke_width+d.points[h].x/100*(v-2*d.default_style.stroke_width))+","+(f=d.default_style.stroke_width+d.points[h].y/100*(m-2*d.default_style.stroke_width))+" ";i+='           "></polygon>',i+="       </svg>",i+="   </div>",i+='       <svg class="imp-editor-shape-poly-svg-overlay" viewBox="0 0 '+v+" "+m+'" preserveAspectRatio="none">',i+='           <polygon points="';for(h=0;h<d.points.length;h++){var _=d.points[h].x/100*v,f=d.points[h].y/100*m;i+=_+","+f+" "}i+='           "></polygon>',i+="       </svg>",i+='   <div class="imp-selection imp-expanded-selection">',i+='       <div class="imp-selection-translate-boxes">',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-1" data-transform-direction="1" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-2" data-transform-direction="2" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-3" data-transform-direction="3" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-4" data-transform-direction="4" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-5" data-transform-direction="5" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-6" data-transform-direction="6" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-7" data-transform-direction="7" data-editor-object-type="5"></div>',i+='           <div class="imp-selection-translate-box imp-selection-translate-box-8" data-transform-direction="8" data-editor-object-type="5"></div>',i+="       </div>",i+="   </div>";for(var h=0;h<d.points.length;h++)i+='       <div class="imp-poly-control-point" data-editor-object-type="7" data-index="'+h+'" style="left: '+d.points[h].x+"%; top: "+d.points[h].y+'%;"></div>';i+="</div>"}}return i+="</div>",i+="</div>"}}(jQuery,window,document);