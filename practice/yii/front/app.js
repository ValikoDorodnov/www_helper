import Transformer from "./transformer/transformer.ts";
import Gun from './transformer/gun.ts';
import Bike from './transformer/bike.ts';

const gun = new Gun({ammo: 10});
const bike = new Bike({isFueled: true});
const transformer = new Transformer({name: 'Optimus', gun: gun, bike: bike});

transformer.fire();
transformer.ride();
transformer.scream();