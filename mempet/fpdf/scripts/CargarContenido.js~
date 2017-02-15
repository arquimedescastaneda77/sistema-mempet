function _CargarContenido(url,id,modulo){
	if(url==''||id=='') return;
	conexion1=crearXMLHttpRequest();
	conexion1.open("GET",url,true);
	conexion1.onreadystatechange = function(){
				if(conexion1.readyState == 4){
// 					xGetElementById(id+'X_CONTENIDO').innerHTML = "<DIV id='"+id+"X_CONTENIDO_CARGADO' style=\"visibility : hidden;\"></DIV>";
					xGetElementById(id).innerHTML = conexion1.responseText;
// 					xStyle('visibility','inherit',id+'X_CONTENIDO_CARGADO');
				
					VentanaInicializar(modulo);
 				
//	xStyle('overflow','auto',id);
					}
                                             }
	conexion1.send(null);
	}


function crearXMLHttpRequest(){
     try{objetus = new ActiveXObject("Msxml2.XMLHTTP");}
     catch(e){
          try{objetus=new ActiveXObject("Microsoft.XMLHTTP");}
          catch(E){objetus=false;}
          }
     if(!objetus && typeof XMLHttpRequest!='undefined'){objetus=new XMLHttpRequest();}
     return objetus;
     }