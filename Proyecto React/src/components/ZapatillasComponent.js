import React, { Component } from 'react';
import axios from 'axios';
import 'jquery';
import 'bootstrap/dist/js/bootstrap';

class ZapatillasComponent extends Component {

    state = {
        calzado: [],
        info: "",
        name: "",
    }

    Ventana_modal(descripcion, nombre){
        this.setState({info: descripcion});
        this.setState({name: nombre});
    }

    /*

    {
  "data": [
    {
      "nombre": "Converse all star",
      "descripcion": "Las Converse All Star Chuck ’70 se han rediseñado con detalles modernos que rinden homenaje al estilo original de las Chuck Taylor All Star de los 70. Cuentan con un ribete de goma algo más alto, una plantilla con amortiguación para una comodidad duradera y una puntera de goma más grande.",
      "foto": "https://www.prodirectbasketball.com/productimages/V3_1_Main/4688_Main_Thumb_0562505.jpg",
      "tallas": [
        "37",
        "39",
        "40",
        "41",
        "42"
      ]
    },
    {
      "nombre": "Botas de montaña",
      "descripcion": "Diseño de punta elegante, vista, personalidad, tenemos más tamaños Diseño de color para usted y su familia o amante O amigos seleccione. Material de alta calidad, cómodo y suave, reduce el estrés en las articulaciones, fortalece y tonifica, mejora la postura.",
      "foto": "https://gioseppo.com/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/4/6/46503-camel-01.jpg",
      "tallas": [
        "39",
        "40",
        "41",
        "42",
        "43",
        "44"
      ]
    },
    {
      "nombre": "Botines",
      "descripcion": "Botas de tacon para mujer o no, hechas con material del bueno y perfectas para presumir con amigas y amigos",
      "foto": "https://contestimg.wish.com/api/webimage/56f66404d2cd0e5caf5558ce-large.jpg?cache_buster=49cc4a4c67fe3522839e53c7408362ae",
      "tallas": [
        "36",
        "37",
        "38",
        "39",
        "40"
      ]
    },
    {
      "nombre": "Puma ferrari",
      "descripcion": "De material sintético e importado, con suela de goma. El eje mide aproximadamente low-top desde el arco. Zapatillas inspiradas en Moto.",
      "foto": "https://basketo.co.uk/eng_pl_Puma-Ferrari-Cat-5-Ultra-Shoes-305921-01-20702_1.png",
      "tallas": [
        "39",
        "41",
        "43",
        "45"
      ]
    },
    {
      "nombre": "Zapatos de piel",
      "descripcion": "Zapato de estilo ingles realizado en Cambridge Cuero. Fabricación realizada en cosido Goodyear y piso York. Horma de calce confortable, punta redonda y apariencia alargada.",
      "foto": "https://yanko1890.es/wp-content/uploads/2017/09/14404-Cambridge-Cuero-B.jpg",
      "tallas": [
        "40",
        "42",
        "44",
        "45"
      ]
    },
    {
      "nombre": "Tacones Olga",
      "descripcion": "Un buen aliado para este invierno, el pump de tacón fino de 9 centímetros en ante negro queda fenomenal con todas las tendencias de moda. Fáciles de llevar, siguen una línea y una proporción que estilizan la figura incluso sin tener mucha altura.",
      "foto": "https://www.puralopez.com/uploads/images/products/salon-negro-ante-tacon-pura-lopez-olga1.jpg",
      "tallas": [
        "35",
        "36",
        "37",
        "38",
        "40"
      ]
    }
  ]
}
    https://api.myjson.com/bins/1diwp0
    http://myjson.dit.upm.es/api/bins/1p15 Si se elimina el json del host volver a Myjson y guardar otra ruta
    */

    render(){

        axios.get("http://myjson.dit.upm.es/api/bins/1p15")
        .then (res => {

            this.setState({
               calzado: res.data.data
            })
        })

        return (
            <div>              
                <h2 className="titulo_prendas mt-3">Listado de calzados</h2>
                <div className="row">
                    {this.state.calzado.map((calzado, i) =>{
                        return(
                            <div className="col-12 col-md-6 col-xl-4" data-toggle="modal" data-target="#myModal" onClick={() => this.Ventana_modal(calzado.descripcion,calzado.nombre)}>
                                <div className="m-1 d-flex carta">
                                  <img className="imagen_prenda" src={calzado.foto} alt="Card image cap"/>
                                  <div className="card-body">
                                    <h5 className="card-title">{calzado.nombre}</h5>
                                    <p className="card-text">Tallas Disponibles: </p>
                                    {calzado.tallas.map((talla, i) =>{
                                      return(
                                        <h5>{talla}</h5>
                                      )
                                    })}
                                  </div>
                                </div>
                            </div>
                        )
                    })}
                </div>
                
                {
                  //VENTANA MODAL
                }
                <div className="modal fade" id="myModal" role="dialog">
                  <div className="modal-dialog">
                    <div className="modal-content">
                      
                      <div className="modal-header bg-dark">
                        <h4 className="modal-title text-light">{this.state.name}</h4>
                        <button type="button" className="close" data-dismiss="modal">&times;</button>
                      </div>
                      
                      <div className="modal-body">
                        <p id="info_producto">{this.state.info}</p>
                      </div>
                      
                      <div className="modal-footer bg-dark">
                        <button type="button" className="btn btn-default bg-white" data-dismiss="modal">Cerrar</button>
                      </div>
                    
                    </div>
                  </div>
                </div>
            </div>
        );
        
    }
}

export default ZapatillasComponent;