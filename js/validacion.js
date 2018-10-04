///******************************************************************************************************************/
///********************************************** REDALONE STYLE v.3.0 **********************************************/
///* Desarrollo por Pedro Fernández Bosch y David Rojas Quesada */
///* Adaptación para Reddelsur Control Panel v.2.0 */
///* 31/05/2010 */
///* https://github.com/pebosch/fakenews */
///* Esta obra está bajo una licencia GNU LGPLv3 */
///******************************************************************************************************************/

function $(id) {
    return document.getElementById(id);
}

//Nos dice si la cadena es texto vacio o no                                  
function vacio(cadena)
{                                      // DECLARACION DE CONSTANTES
    var blanco = " \n\t" + String.fromCharCode(13); // blancos
    // DECLARACION DE VARIABLES
    var i;                             // indice en cadena
    var es_vacio;                      // cadena es vacio o no
    for (i = 0, es_vacio = true; (i < cadena.length) && es_vacio; i++) // INICIO
        es_vacio = blanco.indexOf(cadena.charAt(i)) != -1;
    return(es_vacio);
}

function hideshow() {
    var frm = form1;
    if (frm.style.display == "block") {
        frm.style.display = "none"
    }
    else
    if (frm.style.display == "none") {
        frm.style.display = "block"
    }
}
function show1() {
    document.getElementById('div2').style.display = 'none';
    document.getElementById('div1').style.display = 'block';
}
function show2() {
    document.getElementById('div2').style.display = 'block';
    document.getElementById('div1').style.display = 'none';
}

function valida(f) {
    var ok = false;
    var al_menos_uno = false;
    var noticia_leida = false;
    var usado_buscador = false;
    var msg = "Debes seleccionar una opcion:\n";


    if (f.newsread.checked) {
        noticia_leida = true;
        $('eLeerNoticia_error').style.display = 'none';
    } else {
        $('eLeerNoticia_error').style.display = 'block';
    }
    if (f.websearch.checked) {
        usado_buscador = true;
        $('eContrastarNoticia_error').style.display = 'none';
    } else {
        $('eContrastarNoticia_error').style.display = 'block';
    }

    if (f.ynquestion[0].checked) {
        $('eVotarNoticia_error').style.display = 'none';
        //verificamos que haya al menos una respuesta
        if (f.yarguments0.checked) {
            al_menos_uno = true;
        }
        if (f.yarguments1.checked) {
            al_menos_uno = true;
        }
        if (f.yarguments2.checked) {
            al_menos_uno = true;
        }
        if (f.yarguments3.checked) {
            al_menos_uno = true;
        }
        if (f.yarguments4.checked) {
            al_menos_uno = true;
        }
        if (f.yarguments5.checked) {
            al_menos_uno = true;
        }
        if (f.yarguments6.checked) {
            al_menos_uno = true;
        }
        if (f.yarguments7.checked) {
            al_menos_uno = true;
        }
        if (f.yarguments8.checked) {
            al_menos_uno = true;
        }
        if (f.yarguments9.checked) {
            al_menos_uno = true;
        }
        // si no selecciona nada ponemos ok false
        if (al_menos_uno == false) {
            ok = false;
            al_menos_uno = false;
        } else {
            if (noticia_leida == true && usado_buscador == true) {
                ok = true;
            } else {
                ok = false;
            }
        }

    } else {
        if (f.ynquestion[1].checked) {
            $('eVotarNoticia_error').style.display = 'none';
            //verificamos que haya al menos una respuesta
            if (f.narguments0.checked) {
                al_menos_uno = true;
            }
            if (f.narguments1.checked) {
                al_menos_uno = true;
            }
            if (f.narguments2.checked) {
                al_menos_uno = true;
            }
            if (f.narguments3.checked) {
                al_menos_uno = true;
            }
            if (f.narguments4.checked) {
                al_menos_uno = true;
            }
            if (f.narguments5.checked) {
                al_menos_uno = true;
            }
            if (f.narguments6.checked) {
                al_menos_uno = true;
            }
            if (f.narguments7.checked) {
                al_menos_uno = true;
            }
            if (f.narguments8.checked) {
                al_menos_uno = true;
            }
            if (f.narguments9.checked) {
                al_menos_uno = true;
            }

            // si no selecciona nada ponemos ok false
            if (al_menos_uno == false) {
                $('eArgumentosVoto_error').style.display = 'block';
                ok = false;
                al_menos_uno = false;
            } else {
                $('eArgumentosVoto_error').style.display = 'none';
                if (noticia_leida == true && usado_buscador == true) {
                    ok = true;
                } else {
                    ok = false;
                }
            }
        } else {
            $('eVotarNoticia_error').style.display = 'block';
        }
    }

// en caso que no haya ninguno seleccionado o los 2
// verificamos que este marcado el primer radiobutton y algun checkbox
//	if(f.ynquestion[0].checked){
//		al_menos_uno = false;
//		for (var i = 0; i < f.yarguments.length; i++) {
//			if (f.yarguments[i].checked) {
//				al_menos_uno = true;
//			}
//		}
//		if(al_menos_uno==false){ok = false;}
//	}
//	//verificamos que este marcado el primer radiobutton y algun checkbox
//	if(f.ynquestion[1].checked){
//		al_menos_uno = false;
//		for (var i = 0; i < f.narguments.length; i++) {
//			if (f.narguments[i].checked) {
//				al_menos_uno = true;
//			}
//		}
//		if(al_menos_uno==false){ok = false;}
//	}

    /* if(ok == false)
     alert(msg);*/

    return ok;
}