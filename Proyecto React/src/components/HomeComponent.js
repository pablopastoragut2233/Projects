import React, { Component } from 'react';
import { Carousel } from 'react-bootstrap';

class HomeComponent extends Component {

    render(){

        return (
            <div>              
                <Carousel>
                    <Carousel.Item>
                        <img className="imagenSlider d-block" src={require('../assets/ropa2.jpg')} alt="First slide"/>
                        <Carousel.Caption>
                            <h3 className="tituloslider">Moda de Hombre</h3>
                            <p className="textoslider">Encuentra en la sección de prendas tu estilo</p>
                        </Carousel.Caption>
                    </Carousel.Item>
                    
                    <Carousel.Item>
                        <img className="imagenSlider d-block" src={require('../assets/ropa3.jpg')} alt="Third slide"/>
                        <Carousel.Caption>
                            <h3 className="tituloslider">Variedad de marcas</h3>
                            <p className="textoslider">Si buscas algo en concreto lo encontrarás</p>
                        </Carousel.Caption>
                    </Carousel.Item>
                    
                    <Carousel.Item>
                        <img className="imagenSlider d-block" src={require('../assets/ropa1.jpg')} alt="Third slide"/>
                        <Carousel.Caption>
                            <h3 className="tituloslider">Calidad Suprema</h3>
                            <p className="textoslider">Cosidas a mano por los grandes elfos del oeste</p>
                        </Carousel.Caption>
                    </Carousel.Item>

                    <Carousel.Item>
                        <img className="imagenSlider d-block" src={require('../assets/ropa4.jpg')} alt="Third slide"/>
                        <Carousel.Caption>
                            <h3 className="tituloslider">Siempre apunto</h3>
                            <p className="textoslider">Disfruta de la nueva colección de otoño</p>
                        </Carousel.Caption>
                    </Carousel.Item>
                    <Carousel.Item>
                        <img className="imagenSlider d-block" src={require('../assets/ropa5.jpg')} alt="Third slide"/>
                        <Carousel.Caption>
                            <h3 className="tituloslider">Comodidad ante todo</h3>
                            <p className="textoslider">Pide ya tu talla de calzado idela</p>
                        </Carousel.Caption>
                    </Carousel.Item>
                </Carousel>


            </div>
        );
        
    }
}

export default HomeComponent;