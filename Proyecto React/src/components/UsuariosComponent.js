import React, { Component } from 'react';

class UsuariosComponent extends Component {

    constructor(props) {

        super(props);
        
    }

    state = {
        usuarios: [{nombre: "Pablo", sugerencia: "Me gustan las chaquetas quiero más"}, {nombre: "Cristian", sugerencia: "No hay camisetas de one piece esto es una mierda"},
        {nombre: "Rafa", sugerencia: "Por alguna razón no encuentro nada de mi talla"}]
     }

    render(){

        if(this.props.nombre){//Si le llega el nombre del formulario lo muestra junto con la lista de ususarios
            return (
                <div className="sugerencias_usuarios m-3">              
                    <h2 className="titulo_prendas mt-3">Sugerencias de usuarios</h2>
                    <div className="m-3 p-3">
                        <div className="lista_sugerencias">
                            <div className="mb-5">
                                <h4 className="font-italic">{this.props.nombre}</h4>
                                <p className="sugerenciap">{this.props.sugerencia}</p>
                            </div>
                            {this.state.usuarios.map((usuario, i) =>{
                            return(
                                <div className="mb-5">
                                    <h4 className="font-italic">{usuario.nombre}</h4>
                                    <p>{usuario.sugerencia}</p>
                                </div>
                                )
                            })}
                            { this.state.usuarios.unshift({nombre: this.props.nombre, sugerencia: this.props.sugerencia}) }
                        </div>
                    </div>
                </div>
            );
        }else{//Si no le llega el nombre del formulario solo muestra la lista
            return (
                <div className="sugerencias_usuarios m-3">              
                    <h2 className="titulo_prendas mt-5">Sugerencias de usuarios</h2>
                    <div className="m-3 p-3"> 
                        <div className="lista_sugerencias">
                            {this.state.usuarios.map((usuario, i) =>{
                            return(
                                <div className="mb-5">
                                    <h4 className="font-italic">{usuario.nombre}</h4>
                                    <p className="sugerenciap">{usuario.sugerencia}</p>
                                </div>
                                )
                            })}
                        </div>
                    </div>
                </div>
            );
        }
        
    }
        
}

export default UsuariosComponent;