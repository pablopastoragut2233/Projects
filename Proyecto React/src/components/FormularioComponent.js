import React, { Component } from 'react';
import UsuariosComponent from './UsuariosComponent';

class FormularioComponent extends Component {

    state = {
        nombre: "",
        email: "",
        sugerencias: "",
        datosStyle: {
            display: "none" //Datos de usuario desactivados por defecto
        }     
    }


    nombreUsuarioRef = React.createRef();
    emailUsuarioRef = React.createRef();
    sugerenciasUsuarioRef = React.createRef();

    render(){
       
        return (
            <div>              
                <h2 className="titulo_prendas mt-3">Formulario de usuario</h2>
                <form className="row formulario m-3 p-3 bg-dark" onSubmit={this.recibirDatos}>
                    <input type="text" className="col-md-6 mt-3" name="nombre" placeholder="Nombre" ref={this.nombreUsuarioRef}/>
                    <input type="text" className="col-md-6 mt-3" name="email" placeholder="Email" ref={this.emailUsuarioRef}/>
                    <textarea className="col-12 form-control mt-3" rows="5" name="sugerencias" ref={this.sugerenciasUsuarioRef} placeholder="Sugerencias"></textarea>
                    <button type="submit" className="col-4 col-md-2 col-xl-1 mt-3 boton_enviar">Enviar</button>
                </form>
          
                <div className="m-3 p-3 mb-5 bg-dark" style={this.state.datosStyle}>
                    <h3 className="text-light titulito">Datos de usuario:</h3>
                    <p className="text-light"><label className="texto_dato"> Nombre:</label> {this.state.nombre}</p>
                    <p className="text-light"><label className="texto_dato"> Email:</label> {this.state.email}</p>
                    <p className="text-light"><label className="texto_dato"> Sugerencias:</label> {this.state.sugerencias}</p>
                </div>
                <UsuariosComponent nombre={this.state.nombre} sugerencia={this.state.sugerencias}/>       
            </div>
        );
        
    }

    recibirDatos = (e) =>{
        e.preventDefault();

        this.setState({nombre: this.nombreUsuarioRef.current.value});
        this.setState({email: this.emailUsuarioRef.current.value});
        this.setState({sugerencias: this.sugerenciasUsuarioRef.current.value});
        //Hacer que la capa se muestre cambiando el estilo del state
        this.setState({datosStyle:{dispaly: "block"}});
        //Al principio al componente usuarios le llegan las variables vacias
        //Forzar el return otra vez porque ahora si le llegarán las variables de props
        this.forceUpdate();

    }
}

export default FormularioComponent;