var tabPane;
/*
function contenidoInicializar(modulo)
{

    switch(modulo){
		
	
	case 'personal': alert("hola");
	break;


	default: 



    }
	



}*/
function quitar_boton(id1,id2,id3){
	
	if(xGetElementById('TIPO_USUARIO').value=="3")
	{
		xGetElementById(id1).style.visibility="hidden";
		xGetElementById(id2).style.visibility="hidden";
		xGetElementById(id3).style.visibility="hidden";

	}else 
	    if(xGetElementById('TIPO_USUARIO').value=="2"){
	
		xGetElementById(id1).style.visibility="visible";
		xGetElementById(id2).style.visibility="visible";
		xGetElementById(id3).style.visibility="visible";

	}

}

function ocultar_boton(id1,id2){

	if(xGetElementById('TIPO_USUARIO').value=="3")
	{
		xGetElementById(id1).style.visibility="hidden";
	}else 
	    if(xGetElementById('TIPO_USUARIO').value=="2"){
	
		xGetElementById(id2).style.visibility="hidden";
	}
}


function MENSAJE_MsgOnSuccess(mensaje,id){
	xGetElementById(id).setAttribute('class','estilo_msg_on_success');
	xGetElementById(id).innerHTML=mensaje;	
	}

function MENSAJE_MsgOnError(mensaje,id){ //FUNCION QUE IMPRIME UN MENSAJE DE ERROR 
	xGetElementById(id).setAttribute('class','estilo_msg_on_error');
	xGetElementById(id).innerHTML=mensaje;	
	}



function mostrar_ocultar_general(condicion,id_select,td1,td2,td3,td4)
{
	//alert("hola entro en la funcion");
	if (xGetElementById(id_select).value.toUpperCase()==condicion.toUpperCase())
		{
			xGetElementById(td1).style.visibility="visible";//visible 
			
			if(td2)
			xGetElementById(td2).style.visibility="visible";

			if(td3)
			xGetElementById(td3).style.visibility="visible";

			if(td4)
			xGetElementById(td4).style.visibility="visible";

			
		}else{
	
			xGetElementById(td1).style.visibility="hidden";

			if(td2)
			xGetElementById(td2).style.visibility="hidden";

			if(td3)
			xGetElementById(td3).style.visibility="hidden";

			if(td4)
			xGetElementById(td4).style.visibility="hidden";
		}

}


function desactivarBoton(b1,b2,b3){

	if(b1){
		xGetElementById(b1).disabled=true;// actiar un boton o campo en particular
		xGetElementById(b1).setAttribute('class','estilo_botones_desactivados');
	}
	if(b2){	
		xGetElementById(b2).disabled=true;
		xGetElementById(b2).setAttribute('class','estilo_botones_desactivados');
	}
	if(b3){	
		xGetElementById(b3).disabled=true;
		xGetElementById(b3).setAttribute('class','estilo_botones_desactivados');
	}


}


function activarBoton(b1,b2,b3){

	if(b1){
		xGetElementById(b1).disabled=false;// actiar un boton o campo en particular
		xGetElementById(b1).setAttribute('class','estilo_botones');
	}
	if(b2){
		xGetElementById(b2).disabled=false;
		xGetElementById(b2).setAttribute('class','estilo_botones');
	}
	
	if(b3){
		xGetElementById(b3).disabled=false;
		xGetElementById(b3).setAttribute('class','estilo_botones');
	}

}


function quitarfila(IdTabla){

var _nodo=xGetElementById(IdTabla);
var _N=_nodo.childNodes.length;
if(_N-1<0)
	return;
_nodo.removeChild(_nodo.childNodes[_N-1]);

}

function limpiarTabla(IdTabla){
    var nodo=xGetElementById(IdTabla);
    nodo.innerHTML="";
    /*while(nodo.hasChildNodes()){
    nodo.removeChild(nodo.lastChild);
    }*/
	//tabla.rows[i].cells[j].innerHTML;
}

var colorBase; //se define la variable q captura el color de la tabla
var colorSeleccionTabla='#C7C7EB';
var colorFondoTabla='#EBEBEB';
var colorFilaCuentaAgregada='#B9C8FF';

function pintarFila(fila){ //recibe el id de la fila q se desea pintar
    colorBase=xGetElementById(fila).bgColor; //se captura el color base de la tabla
    xGetElementById(fila).bgColor='#FAF9DC';//agrega el nuevo color FAF8C8
//alert(IDSeleccionActualLista);
}

function activarChekbox(fila){
    xGetElementById(fila).checked=true;
}

function desactivarChekbox(fila){
    xGetElementById(fila).checked=false;
}

function despintarFila(fila){

    xGetElementById(fila).bgColor=colorBase;//cambia el color de la fila al color base q se capturo en pintarFila
}


function restaurarColorTabla(IDTabla){
    var _nodo=xGetElementById(IDTabla);
    var _N=_nodo.childNodes.length;
    for(var i=0;i<_N;i++)
        _nodo.childNodes[i].bgColor = colorFondoTabla;
}


function str_replace(_text,_replace,_search){//esta funcion reemplaza la 
    return _text.split(_search).join(_replace);
}


function strtoupper(_cadena){
	if(!_cadena)
		return "";
    return _cadena.toUpperCase();
	}

//***********************************************************************************************
// validarFecha(dia,mes, año)
//
// Valida que el día y el mes introducidos sean correctos. Además valida que el año introducido
// sea o no bisiesto
//
//***********************************************************************************************
function EsFechaValida(cadena){
    var FECHA=cadena.split("/");
    if(FECHA.length!=3)
        return false;

    var dia=FECHA[0];	
    if(dia.length!=2||isNaN(dia))
        return false;

    var mes=FECHA[1];
    if(mes.length!=2||isNaN(mes))
        return false;

    var anio=FECHA[2];
    if(anio.length!=4||isNaN(anio))
        return false;

    var elMes = parseInt(mes);
    if(elMes>12)
        return false;

    // MES FEBRERO
    if(elMes == 2){
        if(esBisiesto(anio)){
            if(parseInt(dia) > 29)
                return false;
            else
                return true;
        }
        else{
        if(parseInt(dia) > 28)
            return false;
        else
            return true;
        }
    }

    //RESTO DE MESES	
    if(elMes== 4 || elMes==6 || elMes==9 || elMes==11){
        if(parseInt(dia) > 30)
            return false;
    }
    else
        if(parseInt(dia) > 31)
            return false;
    return true;
}


function esBisiesto(ano){
    return ((ano%4==0 && ano%100!=0)||(ano%400==0)?true:false)
}


function comparaFechas(fecha_inicio, fecha_fin){

	var fecha_inicio = fecha_inicio.split('/');
	var fecha_fin = fecha_fin.split ('/');

	if(fecha_inicio[2]<fecha_fin[2])
		return true;
	else if (fecha_inicio[2]>fecha_fin[2])
		return false;
	else if(fecha_inicio[2]==fecha_fin[2])
		{
			if(fecha_inicio[1]<fecha_fin[1])
				return true;
			else if (fecha_inicio[1]>fecha_fin[1])
				return false;
			else if(fecha_inicio[1]==fecha_fin[1])
				{
					if(fecha_inicio[0]<=fecha_fin[0])
						return true;
					else if (fecha_inicio[0]>fecha_fin[0])
						return false;
					
				}
				

		}


}


var completarCodigoCeros_CantidadMin=3;

function completarCodigoCeros(cadena,tamano){
//     if(tamano<completarCodigoCeros_CantidadMin)
//         tamano=completarCodigoCeros_CantidadMin;
	if(!tamano)
		tamano=3;
	cadena=String(cadena);
    var p=new String("");
    for(;tamano>cadena.length;tamano--)
        p+='0';
    return (p+=cadena);
}


var completarCodigoCeros_CantidadMin2=2;

function completarCodigoCeros2(cadena,tamano){
    if(tamano<completarCodigoCeros_CantidadMin2)
        tamano=completarCodigoCeros_CantidadMin2;
    var p=new String("");
    for(;tamano>cadena.length;tamano--)
        p+='0';
    return (p+=cadena);
}

function quitarCodigoCeros(cadena){
    cadena=String(cadena);
    var I=0;
    while(cadena.charAt(I) == '0')
        I++;	
    return cadena.substring(I);
}


function NDigitosCodigo(Arreglo,ID){
    var n=Arreglo.length;
    if(n==0 || !n)
        return 0;
    var MAX=Arreglo[0][ID];
    for(var i=1; i<n; i++)
        if(parseInt(Arreglo[i][ID])>MAX)
            MAX=parseInt(Arreglo[i][ID]);
    return NDigitos=String(MAX).length;
}


function DarFoco(ID){
    if(xGetElementById(ID))
        xGetElementById(ID).focus();
}


function DarFocoCampo(ID,Tiempo){
    setTimeout("DarFoco('"+ID+"')",Tiempo);
}


//función que valida que se introduzcan sólo números y ciertos caracteres
// NOTA: Backspace=8, Enter=13, '0'=48, '9'=57, Suprimir=127
function soloNum(evt)
{	
    var nav4=window.Event?true:false;
    var key=nav4?evt.which:evt.keyCode;
    return (key<=13 || key==127 || (key>=48 && key<=57));
}

function soloChar(evt)
{	
    var nav4=window.Event?true:false;
    var key=nav4?evt.which:evt.keyCode;
    return (key<=13 || key==127 || (key>=65 && key<=90)||(key>=97 && key<=122));
}

function AcceptNum(evt,ID,Negativo,Porcentaje){
    var nav4 = window.Event ? true : false;
    var key = nav4 ? evt.which : evt.keyCode;
    if(xGetElementById(ID)){
            var Cadena=xGetElementById(ID).value;
            if(key==45 && Negativo){//si es - y esta activado para aceptar numeros negativos
                    if(Cadena.indexOf("-")==-1)//si no encuentra -, lo colocamos al inicio, retornamos falso para que no se el incluya - donde presionamos
                            xGetElementById(ID).value="-"+Cadena;				
                    return false;
                    }
            else if(key==46){//si es punto
                    if(Cadena.length==0)//si la cadena tiene longitud 0 no puedo meter .
                            return false;
                    if(Cadena.indexOf(".")==-1)//solo debe haber un . en la cadena
                            return true;
                    return false;
                    }
            else if(key==48){//si es cero
                    if(Cadena.length==1 && Cadena.indexOf("0")==0)//si hay un caracter en la cadena y ese caracter es cero, no puedo meter otro cero
                            return false;
                    return true;
                    }
            else if(key==37 && Porcentaje){//si es % y esta activado porcentaje
                    if(Cadena.indexOf("%")==-1)
                            xGetElementById(ID).value=Cadena+"%";
                    return false;
                    }
            }
    if(key==13) return false;//necesario para evitar recargas de pagina (ocurre ocacionalmente al presionar enter en el input text de una tabla. ejemplo presupuesto->formulacion)
    return (key <= 13 || (key >= 48 && key <= 57) || key == 46);
}



function FormatearFecha(cadena){ //recibe la fecha en año-mes-dia de la BD y la convierte en dia/mes/ano para mostrarlos
        var FECHA=String(cadena).split("-");
        return FECHA[2]+"/"+FECHA[1]+"/"+FECHA[0];
        }


function DesFormatearFecha(cadena){ //recibe la fecha en dia/mes/ano y la convierte la cadena de fecha en año-mes-dia para guardarla en la base de datos
        var FECHA=String(cadena).split("/");
        return FECHA[2]+"-"+FECHA[1]+"-"+FECHA[0];
        }


function FormatearNumero(num){
        num = num.toString().replace(/$|,/g,'');
        if(isNaN(num))
        num = "0";
        sign = (num == (num = Math.abs(num)));
        num = Math.floor(num*100+0.50000000001);
        cents = num%100;
        num = Math.floor(num/100).toString();
        if(cents<10)
        cents = "0" + cents;
        for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
                num = num.substring(0,num.length-(4*i+3))+'.'+num.substring(num.length-(4*i+3));
        return (((sign)?'':'-') + num + ',' + cents);
        }


function URLgetValues(){
        var urlEnd = document.URL.indexOf('?');
        var values = new Array();
        var names;	
        if (urlEnd != -1){
                var params = document.URL.substring(urlEnd+1, document.URL.length).split('&');		
                for(i=0; i<params.length; i++) {
                        names = params[i].split('=');
                        values[names[0]] = names[1];
                        }
                }
        return values;
        }


/*Activa todos los campos de un formulario*/
function activarFormulario(id)
{
    var formulario=xGetElementById(id);

    for (i=0;i<formulario.elements.length;i++)
    {
        tipo=formulario.elements[i].type;
        if(tipo == "select-one" || tipo == "radio" || tipo == "checkbox" || tipo == "button" || tipo == "file")
            formulario.elements[i].disabled=false;
        else
        {
            formulario.elements[i].readOnly=false;
            formulario.elements[i].disabled=false;
        }

        if (tipo)
           formulario.elements[i].setAttribute('class','TextoCampoInputObligatorios');
    }

}

/*Desactiva todos los campos de un formulario*/
function desactivarFormulario(id)
{
    var formulario=xGetElementById(id);

    for (i=0;i<formulario.elements.length;i++)
    {
        tipo=formulario.elements[i].type;
        if(tipo == "select-one" || tipo == "radio" || tipo == "checkbox" || tipo == "button" || tipo == "file")
            formulario.elements[i].disabled=true;
        else
        {
            formulario.elements[i].readOnly=true;
            formulario.elements[i].disabled=true;
        }

        if (tipo)
            formulario.elements[i].setAttribute('class','TextoCampoInputDesactivado');
    }
}

//Redimensionar la foto del personal a 195x175 para mostrar
var ancho, alto;
function redimensionar(xx,yy,ruta)
{
    var n, p;
    var maxAlto=175;
    var maxAncho=195;
    if (xx>yy)
    {
        if (xx>maxAncho)
        {
            n=xx-maxAncho;
            p=(n*100)/xx;
            alto=yy*(1-p/100);
        }
        else
        {
            n=maxAncho-xx;
            p=(n*100)/xx;
            alto=yy*(1+p/100);
        }
        ancho=maxAncho;
    }
    else if (xx<yy)
    {
        if (yy>maxAlto)
        {
            n=yy-maxAlto;
            p=(n*100)/yy;
            ancho=xx*(1-p/100);
        }
        else
        {
            n=maxAlto-yy;
            p=(n*100)/yy;
            ancho=xx*(1+p/100);
        }
        alto=maxAlto;
    }
    else
    {
        ancho=maxAncho;
        alto=maxAlto;
    }
    xGetElementById('imgFotoPersonal').width = ancho;
    xGetElementById('imgFotoPersonal').height = alto;
    xGetElementById('imgFotoPersonal').src = ruta;

}


extArray = new Array(".gif", ".jpg", ".png", ".jpeg", ".bmp");
function LimitAttach(form, file) 
{
    allowSubmit = false;
    if (!file) return;
        while (file.indexOf("\\") != -1)
            file = file.slice(file.indexOf("\\") + 1);

    ext = file.slice(file.indexOf(".")).toLowerCase();
    for (var i = 0; i < extArray.length; i++) 
    {
        if (extArray[i] == ext) 
        { 
            allowSubmit = true; 
            break;
        }
    }
    
    if (allowSubmit) 
        return true;
    else
    {
        alert("Se permiten únicamente archivos con la extensión: " + (extArray.join(" ")) + "\nPor favor, seleccione otro archivo "
        + "e intente de nuevo.");
        return false;
    }
}


function limpiarMensaje(td,mensaje)
{
    var td=xGetElementById(td);
    limpiarTabla(td);
    mD.agregaNodoTexto(td,mensaje);
    mD.agregaAtributo(td,{'style':'background-color:#FFFFFF;'});
}

function numberFormat(num,dec){
	if(xTrim(String(num))=="") 
		return "0.00";
	var N=redondear(num,dec);
	if(N==0) 
		return "0.00";
	return N;
	}

function redondear(num,dec)
{
    var numstr=String(num);//Ej. redondear(3.31545,2)

    if(numstr.indexOf(".") == -1)
    {
        numstr = numstr + ".";
        for(nfi=0;nfi<dec;nfi++) 
            numstr = numstr + "0";
    }

    partes=numstr.split("."); //dividimos por el punto para separar el entero del decimal Ej. 3|31545

    if (partes[1].length>dec)
    {
        comadecimal="0."+partes[1];
        partes[1]=partes[1].substr(0,dec+1); //tomamos los dec+1 dígitos de la parte decimal Ej.315

        //truncamos las parte decimal a dec dígitos
        truncamiento=comadecimal.substr(0,dec+2);
        decimal=parseFloat(truncamiento);

        if (parseInt(partes[1].charAt(dec))>=5) //si el siguiente a dec >= 5 Ej. el 3er caracter de 315 es 5
            decimal=decimal+(1/(Math.pow(10,dec))); //incrementamos en 1 la parte decimal Ej. 0.32

        //sumamos la parte entera más la decimal Ej. 3+0.32=3.32
        numstr=parseFloat(parseInt(partes[0],10)+decimal);
    }
    return (parseFloat(numstr));
}

function RecortarTexto(cadena,TAM_MAX){
	if(!TAM_MAX)
		return cadena;
	if(cadena.length>=TAM_MAX)
		return cadena.substring(0,TAM_MAX)+"...";
	return cadena;
	}

function mesEnLetras(mes)
{
	mes=parseInt(mes,10);
	if (mes==1)
		mes="ENERO";
	else if (mes==2)
		mes="FEBRERO";
	else if (mes==3)
		mes="MARZO";
	else if (mes==4)
		mes="ABRIL";
	else if (mes==5)
		mes="MAYO";
	else if (mes==6)
		mes="JUNIO";
	else if (mes==7)
		mes="JULIO";
	else if (mes==8)
		mes="AGOSTO";
	else if (mes==9)
		mes="SEPTIEMBRE";
	else if (mes==10)
		mes="OCTUBRE";
	else if (mes==11)
		mes="NOVIEMBRE";
	else if (mes==12)
		mes="DICIEMBRE";
	
	return mes;
}

function fecha( cadena ) {  
   
    //Separador para la introduccion de las fechas  
    var separador = "/";  
   
    //Separa por dia, mes y año  
    if ( cadena.indexOf( separador ) != -1 )
    {  
         var posi1 = 0;
         var posi2 = cadena.indexOf( separador, posi1 + 1 );
         var posi3 = cadena.indexOf( separador, posi2 + 1 ); 
         this.dia = cadena.substring( posi1, posi2 );
         this.mes = cadena.substring( posi2 + 1, posi3 );
         this.anio = cadena.substring( posi3 + 1, cadena.length );
    }
    else 
    {  
         this.dia = 0;
         this.mes = 0; 
         this.anio = 0;
    }  
 }




function fecha_Actual()
{

	var mydate=new Date();
	var year=mydate.getYear();

	if (year < 1000)
		year+=1900

	var day=mydate.getDay()
	var month=mydate.getMonth()+1
	if (month<10)
		month="0"+month

	var daym=mydate.getDate()
	if (daym<10)
		daym="0"+daym

	daym=daym-1;
	var fecha= year+"-"+month+"-"+daym;
	return fecha;

}