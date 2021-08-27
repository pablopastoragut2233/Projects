import { Component, OnInit } from '@angular/core';
import { Usuario } from '../modelos/usuario'
import { FirebaseService } from '../firebase.service';

@Component({
  selector: 'app-formulario',
  templateUrl: './formulario.component.html',
  styleUrls: ['./formulario.component.scss']
})
export class FormularioComponent implements OnInit {

  public usuario: Usuario;

  constructor(public servicio: FirebaseService) {
    this.usuario = new Usuario("","","");
   }

  ngOnInit() {
  }

  onSubmit(){
    //llamar a metodo de servicio para insertar datos en la bbdd  
    this.servicio.insertarUsuario(this.usuario.nombre,this.usuario.email,this.usuario.plan);
  }

}
