import React, { Component } from 'react';

class FooterComponent extends Component {

    render(){

        return (
            <div>              
                <footer className="text-light"> 
                    <div className="p-3 container-fluid text-center bg-dark text-md-left"> 
                        <div className="row">       
                            <div className="col-md-6 mt-md-0 mt-3">
                                <h5 className="text-uppercase titulito">Sitios web de ropa</h5>
                                <p>Si no encuentras lo que buscas prueba ha echarle un vistazo a otro tipo de webs. tal vez encuentres algo que te interese.</p>
                            </div>         
                            <hr className="clearfix w-100 d-md-none pb-3"/>       
                            <div className="col-md-3 mb-md-0 mb-3">
                                <h5 className="text-uppercase">Links</h5>
                                <ul className="list-unstyled">
                                    <li>
                                        <a className="link" href="https://www.asos.com/es/search/?q=Ropa&affid=5569&channelref=paid%2Bsearch&ppcadref=2042617658%7C72296572996%7Ckwd-19895710573&kw=%2Bropa&cpn=2042617658&gclsrc=aw.ds&_cclid=Google_Cj0KCQiAyp7yBRCwARIsABfQsnTj16UEQTozbYqlEYg94Q3dImbheWTCIjpTkAbs5ETo3_GSKu3lBlwaAgsYEALw_wcB&gclid=Cj0KCQiAyp7yBRCwARIsABfQsnTj16UEQTozbYqlEYg94Q3dImbheWTCIjpTkAbs5ETo3_GSKu3lBlwaAgsYEALw_wcB">Asos</a>
                                    </li>
                                    <li>
                                        <a className="link" href="https://www.zalando.es/">Zalando</a>
                                    </li>
                                    <li>
                                        <a className="link" href="https://es.boohoo.com/">boohoo</a>
                                    </li>
                                    <li>
                                        <a className="link" href="https://www.laredoute.es/">La redoute</a>
                                    </li>
                                </ul>
                            </div>       
                            <div className="col-md-3 mb-md-0 mb-3">                    
                                <h5 className="text-uppercase">Links</h5>
                                <ul className="list-unstyled">
                                    <li>
                                        <a className="link" href="https://latiendadevalentina.com/">Valentina</a>
                                    </li>
                                    <li>
                                        <a className="link" href="https://www.venca.es/">Venca</a>
                                    </li>
                                    <li>
                                        <a className="link" href="https://es.shein.com/shein-picks.html?url_from=esadgs12_srsa_test01_20191227&gclid=Cj0KCQiAyp7yBRCwARIsABfQsnRYHLCUY5pt-VBr7JQnDSq9iLs3-T-1eW8ebPQeITYGHSiO9WBtnogaAoHvEALw_wcB">Shein</a>
                                    </li>
                                    <li>
                                        <a className="link" href="https://www.emmacloth.com/what's-new.html?url_from=esadgs02_ClothingWholesaleBrands01_20170712&gclid=Cj0KCQiAyp7yBRCwARIsABfQsnREv6Fr5SrdKgP6Pi3_oU2ZHmuVlXYeXs-uEJbhI6_nIEwffgL9eZAaAqupEALw_wcB">Emma Cloth</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>  
                    
                    <div className="copyright text-center py-3">© 2020 Copyright:
                        <a href="https://mdbootstrap.com/education/bootstrap/"> MDBootstrap.com</a>
                    </div>
                </footer>      
           </div>
        );
        
    }
}

export default FooterComponent;