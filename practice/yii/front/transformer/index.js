import Transformer from "./transformer.ts";
import Gun from './gun.ts';
import Bike from './bike.ts';

const gun = new Gun({ammo: 10});
const bike = new Bike({isFueled: true});
const transformer = new Transformer({name: 'Optimus', gun: gun, bike: bike});

transformer.fire();
transformer.ride();
transformer.scream();