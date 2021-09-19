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
interface.

###SimpleSlotGame
*This class simulate a 5\*3 slot machine with horizontal lines and 'W' and 'M' shaped
pay lines by implementing **IGame** interface.*

###SimpleSlotCalculator
*This class implements the **IBoardCalculator** to provide this rules:*

3 cards chain --> 0.2 <br/>
4 card chain --> 2 <br/>
4 card chain --> 10 <br/>

###Slot Command
This class add an artisan command to the application to run the slot machine once.
you can run machine by this command:<br/>
> ``php artisan slot``

####Enjoy your time :)
