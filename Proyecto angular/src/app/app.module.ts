import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import{ RouterModule, Routes } from '@angular/router';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { environment } from "../environments/environment";
import { AngularFireModule } from "@angular/fire";

import { AngularFireDatabaseModule } from "@angular/fire/database";

import { AppComponent } from './app.component';
import { MenuComponent } from './menu/menu.component';
import { HomeComponent } from './home/home.component';
import { CursosComponent } from './cursos/cursos.component';
import { FormularioComponent } from './formulario/formulario.component';
import { InscritosComponent } from './inscritos/inscritos.component';
import { PieComponent } from './pie/pie.component';

const appRoutes: Routes = [
  {path: "home", component: HomeComponent},
  {path: "cursos", component: CursosComponent},
  {path: "inscritos", component: InscritosComponent},
  {path: "formulario", component: FormularioComponent},
  {path: '', redirectTo: '/home', pathMatch: 'full'},
  {path: '**', redirectTo: '/home', pathMatch: 'full' }
];

@NgModule({
  declarations: [
    AppComponent,
    MenuComponent,
    HomeComponent,
    CursosComponent,
    FormularioComponent,
    InscritosComponent,
    PieComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    AngularFireDatabaseModule,
    AngularFireModule.initializeApp(environment.firebaseCursos),
    RouterModule.forRoot(appRoutes,{enableTracing: true})
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
