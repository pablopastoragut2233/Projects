import { Component, OnInit } from '@angular/core';
import { Observable } from 'rxjs';
import { FirebaseService } from '../firebase.service';

@Component({
  selector: 'app-inscritos',
  templateUrl: './inscritos.component.html',
  styleUrls: ['./inscritos.component.scss']
})
export class InscritosComponent implements OnInit {

  items: Observable<any[]>

  constructor(public servicio: FirebaseService) { 
    this.items = servicio.listarCursos();
    
  }

  ngOnInit() {
  }

}
