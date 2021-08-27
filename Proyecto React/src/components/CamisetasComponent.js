import React, { Component } from 'react';
import axios from 'axios';
import 'jquery';
import 'bootstrap/dist/js/bootstrap';

class CamisetasComponent extends Component {

    state = {
        prendas: [],
        info: "",
        name: "",
    }

    Ventana_modal(descripcion, nombre){
      this.setState({info: descripcion});
      this.setState({name: nombre});
    }

    render(){
  
        /*
        {
  "data": [
    {
      "nombre": "Chaqué",
      "descripcion": "El chaqué es el traje de máxima etiqueta para el hombre. Se utiliza en eventos formales y ceremonias de día. Sólo el traje regional de cada país tiene el mismo nivel que el chaqué. ",
      "foto": "https://www.gmsprotocoloyeventos.es/wp-content/uploads/2016/11/chaqu%C3%A9-clasico.jpg",
      "tallas": [
        "S",
        "L",
        "XL"
      ]
    },
    {
      "nombre": "Esmoquin",
      "descripcion": "Un esmoquin o traje de noche masculino es un conjunto de etiqueta semiformal para lucir en fiestas nocturnas. Como entregas de premios, cócteles y otros actos sociales de cierta relevancia, pero sin llegar a la importancia de una velada formal como una boda, recepción oficial o cena de gala.",
      "foto": "https://media.istockphoto.com/photos/business-suit-on-mannequin-picture-id666640754?k=6&m=666640754&s=612x612&w=0&h=oQzGATE0NkGDk7I-XHHc5WL0fD9Wbz_KFpl_c86qnAo=",
      "tallas": [
        "L",
        "M",
        "XL",
        "XXL"
      ]
    },
    {
      "nombre": "Rocker",
      "descripcion": "Alta calidad, máxima calidad y excelente confort. Es una chaqueta muy cálida que te mantiene seco y cálido incluso en condiciones climáticas adversas.",
      "foto": "https://images-na.ssl-images-amazon.com/images/I/615IQCQj9hL._UX522_.jpg",
      "tallas": [
        "L",
        "XL"
      ]
    },
    {
      "nombre": "Sudadera",
      "descripcion": "Prenda gruesa de algodón que se utiliza para hacer deporte. Su uso es común en actividades como el footing o el ciclismo. Se utiliza como prenda de abrigo para realizar ejercicio en el exterior y adopta la forma de una chaqueta o Jersey de manga larga que se coloca sobre la camiseta de deporte.",
      "foto": "https://dhb3yazwboecu.cloudfront.net/1355/sudadera-cremallera-hombre-dark-grey_l.jpg",
      "tallas": [
        "L",
        "M"
      ]
    },
    {
      "nombre": "Vestido de gala",
      "descripcion": "Material exterior y relleno 100% poliéster, espalda al aire, cierre con cremallera, costura bajo el pecho, enaguas.",
      "foto": "https://img01.ztat.net/article/WG/02/1C/06/SQ/11/WG021C06S-Q11@12.jpg?imwidth=156&filter=packshot",
      "tallas": [
        "S",
        "L",
        "M",
        "XL"
      ]
    },
    {
      "nombre": "Malliot",
      "descripcion": "Conjunto maillot perfecto para el baile y la danza.",
      "foto": "https://images-na.ssl-images-amazon.com/images/I/51siaxt9AjL._UX679_.jpg",
      "tallas": [
        "L",
        "M",
        "XL"
      ]
    }
  ]
}
     
     http://myjson.dit.upm.es/api/bins/loh Si se elimina el json del host volver a Myjson y guardar otra ruta  */

        axios.get("http://myjson.dit.upm.es/api/bins/loh")
        .then (res => {

            this.setState({
                prendas: res.data.data
            })
        })

        return (
            <div>     
                <h2 className="titulo_prendas mt-3">Listado de prendas</h2>
                <div className="row">
                    {this.state.prendas.map((prenda, i) =>{
                        return(
                            <div className="col-12 col-md-6 col-xl-4" data-toggle="modal" data-target="#myModal" onClick={() => this.Ventana_modal(prenda.descripcion,prenda.nombre)}>
                                <div className="m-1 d-flex carta">
                                  <img className="imagen_prenda" src={prenda.foto} alt="Card image cap"/>
                                  <div className="card-body">
                                    <h5 className="card-title">{prenda.nombre}</h5>
                                    <p className="card-text">Tallas Disponibles: </p>
                                    {prenda.tallas.map((talla, i) =>{
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

export default CamisetasComponent;