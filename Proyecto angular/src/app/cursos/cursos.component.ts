import { Component, OnInit } from '@angular/core';
import { Observable } from 'rxjs';
import { FirebaseService } from '../firebase.service';

@Component({
  selector: 'app-cursos',
  templateUrl: './cursos.component.html',
  styleUrls: ['./cursos.component.scss']
})
export class CursosComponent implements OnInit {

  items: Observable<any[]>

  constructor(public servicio: FirebaseService) { 
    this.items = servicio.listarCursos();
  }

  ngOnInit() {
  }



}
