import { Injectable } from '@angular/core';
import { Router, CanActivate } from '@angular/router';
import { AuthService } from './auth.service';

@Injectable({
    providedIn: 'root'
})
export class AuthGuardService implements CanActivate {
  constructor(public auth: AuthService, public router: Router) {}
  canActivate() {
    if (!this.auth.isAuthenticated()) {
    this.auth.logout();
    this.router.navigate(['/'])
      return false;
    }
    return true;
  }
}