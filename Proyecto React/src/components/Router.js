import React, { Component } from 'react';
import { BrowserRouter, Route, Switch } from "react-router-dom";

import HomeComponent from './HomeComponent';
import CamisetasComponent from './CamisetasComponent';
import ZapatillasComponent from './ZapatillasComponent';
import FormularioComponent from './FormularioComponent';
import MenuComponent from './MenuComponent';

class Router extends Component {

    render(){

        return (
            
            <BrowserRouter>
                <MenuComponent/>
                <Switch>
                    {/* Configuración de rutas */}
                    <Route exact path="/" component={HomeComponent} />
                    <Route exact path="/home" component={HomeComponent} />
                    <Route exact path="/prendas" component={CamisetasComponent} />
                    <Route exact path="/calzado" component={ZapatillasComponent} />
                    <Route exact path="/Formulario" component={FormularioComponent} />
                    { 
                        //<Route component={Error} /> 
                    }
                </Switch>
            </BrowserRouter>

        );

        
    }
}

export default Router;