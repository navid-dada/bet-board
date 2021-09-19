# Bet Board

This project simulate a slot bet machine which has multiple rows and directions 
for its pay lines.

This project is written with [lumen](https://lumen.laravel.com) framework.

## Component

###IGame:

*This interface provides a frame for all slot machines that can be simulated in this application, It makes possible to create more different slot board with different rules and structures
 without changing the other layers.*

###IBoardCalculator:

*This interface provides a frame to create more diverse calculation rule for every slot machine.*

###Bet Session
This class simulate a betting attempt by the machine. it can be done by any machine that implement the **IGame**
interface;

###




## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

