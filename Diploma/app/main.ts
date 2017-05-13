// модуль запуска приложения в production mode
import {enableProdMode} from '@angular/core';
// платформа для браузера с компилятором.
import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';
// модуль приложения.
import { AppModule } from './app.module';

// компиляция и запуск модуля.
const platform = platformBrowserDynamic();
enableProdMode();
platform.bootstrapModule(AppModule);
