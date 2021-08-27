import React, { Component } from 'react';
import { Navbar, Nav } from 'react-bootstrap';
import {NavLink} from "react-router-dom";


class MenuComponent extends Component {

    render(){

        return (
            <div>              
                <Navbar collapseOnSelect expand="lg" bg="dark" variant="dark">
                <Navbar.Brand>Website de Ropa</Navbar.Brand>
                <Navbar.Toggle aria-controls="responsive-navbar-nav" />
                <Navbar.Collapse id="responsive-navbar-nav">
                    <Nav className="mr-auto">
                        
                       <NavLink className="link" to="/" activeClassName="activo">Home</NavLink>
                       <NavLink className="link" to="/prendas" activeClassName="activo">Prendas</NavLink>
                       <NavLink className="link" to="/calzado" activeClassName="activo">Calzado</NavLink>
                       <NavLink className="link" to="/formulario" activeClassName="activo">Formulario</NavLink>

                    </Nav>
                </Navbar.Collapse>
                </Navbar>
            </div>
        );
        
    }
}

export default MenuComponent;