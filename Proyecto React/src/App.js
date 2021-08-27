import React from 'react';
import './App.css';
import MenuComponent from './components/MenuComponent';
import HeaderComponent from './components/HeaderComponent';
import FooterComponent from './components/FooterComponent';
import HomeComponent from './components/HomeComponent';
import CamisetasComponent from './components/CamisetasComponent';
import ZapatillasComponent from './components/ZapatillasComponent';
import UsuariosComponent from './components/UsuariosComponent';
import FormularioComponent from './components/FormularioComponent';

import Router from './components/Router';
import 'bootstrap/dist/css/bootstrap.min.css';

function App() {
  return (
    <div className="app-body">
      <HeaderComponent/>
      <Router/>
      <FooterComponent/>
    </div>

  );
}

export default App;
