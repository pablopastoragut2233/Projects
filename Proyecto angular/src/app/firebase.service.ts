import { Injectable } from '@angular/core';
import { AngularFireDatabase } from "@angular/fire/database";
import { Observable } from "rxjs";
import { async } from 'q';
import { NgForOf } from '@angular/common';


@Injectable({
  providedIn: 'root'
})
export class FirebaseService {

  items: Observable<any[]>;

  today = new Date();
  day: string;
  month: string;
  year: string;
  fecha: string;

  constructor(public db: AngularFireDatabase) {
    
  }

  listarCursos(){
    this.items = this.db.list("Cursos").snapshotChanges();
    return this.items;
  }

  inscribirse(curso){//Crea la fecha actual y la guarda en la bbdd
    this.day = String(this.today.getDate());
    this.month = String(this.today.getMonth() + 1).padStart(2, '0');
    this.year = String(this.today.getFullYear());
    this.fecha = this.day +"/"+ this.month +"/"+ this.year;

    this.db.list("Cursos").update(curso, {"inscrito": true});
    this.db.list("Cursos").update(curso, {"fecha": this.fecha});
  }

  Darse_de_baja(curso){
    this.db.list("Cursos").update(curso, {"inscrito": false});
  }

  insertarUsuario(nombre,email,plan){
    this.db.list("Usuarios").set(nombre, {"email": email, "plan": plan});
  }

}
