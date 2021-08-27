import React, { Component } from 'react';

class HeaderComponent extends Component {

    render(){

        return (
            <div>              
                <header className="d-flex justify-content-center">
                    <img className="ml-3 mt-1" src={require('../assets/shirt.png')} />
                    <h1 className="ml-1 mt-1 font-italic">Web-Shirts</h1>
                </header>
            </div>
        );
        
    }
}

export default HeaderComponent;