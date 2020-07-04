import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SevenlastdayComponent } from './sevenlastday.component';

describe('SevenlastdayComponent', () => {
  let component: SevenlastdayComponent;
  let fixture: ComponentFixture<SevenlastdayComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SevenlastdayComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SevenlastdayComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
