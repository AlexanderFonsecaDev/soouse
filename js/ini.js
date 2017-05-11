

			// Based on http://www.openprocessing.org/visuals/?visualID=6910

			var Boid = function() {

				var vector = new THREE.Vector3(),
				_acceleration, _width = 500, _height = 500, _depth = 200, _goal, _neighborhoodRadius = 100,
				_maxSpeed = 4, _maxSteerForce = 0.1, _avoidWalls = false;

				this.position = new THREE.Vector3();
				this.velocity = new THREE.Vector3();
				_acceleration = new THREE.Vector3();

				this.setGoal = function ( target ) {

					_goal = target;

				}

				this.setAvoidWalls = function ( value ) {

					_avoidWalls = value;

				}

				this.setWorldSize = function ( width, height, depth ) {

					_width = width;
					_height = height;
					_depth = depth;

				}

				this.run = function ( boids ) {

					if ( _avoidWalls ) {

						vector.set( - _width, this.position.y, this.position.z );
						vector = this.avoid( vector );
						vector.multiplyScalar( 5 );
						_acceleration.add( vector );

						vector.set( _width, this.position.y, this.position.z );
						vector = this.avoid( vector );
						vector.multiplyScalar( 5 );
						_acceleration.add( vector );

						vector.set( this.position.x, - _height, this.position.z );
						vector = this.avoid( vector );
						vector.multiplyScalar( 5 );
						_acceleration.add( vector );

						vector.set( this.position.x, _height, this.position.z );
						vector = this.avoid( vector );
						vector.multiplyScalar( 5 );
						_acceleration.add( vector );

						vector.set( this.position.x, this.position.y, - _depth );
						vector = this.avoid( vector );
						vector.multiplyScalar( 5 );
						_acceleration.add( vector );

						vector.set( this.position.x, this.position.y, _depth );
						vector = this.avoid( vector );
						vector.multiplyScalar( 5 );
						_acceleration.add( vector );

					}/* else {

						this.checkBounds();

					}
					*/

					if ( Math.random() > 0.5 ) {

						this.flock( boids );

					}

					this.move();

				}

				this.flock = function ( boids ) {

					if ( _goal ) {

						_acceleration.add( this.reach( _goal, 0.005 ) );

					}

					_acceleration.add( this.alignment( boids ) );
					_acceleration.add( this.cohesion( boids ) );
					_acceleration.add( this.separation( boids ) );

				}

				this.move = function () {

					this.velocity.add( _acceleration );

					var l = this.velocity.length();

					if ( l > _maxSpeed ) {

						this.velocity.divideScalar( l / _maxSpeed );

					}

					this.position.add( this.velocity );
					_acceleration.set( 0, 0, 0 );

				}

				this.checkBounds = function () {

					if ( this.position.x >   _width ) this.position.x = - _width;
					if ( this.position.x < - _width ) this.position.x =   _width;
					if ( this.position.y >   _height ) this.position.y = - _height;
					if ( this.position.y < - _height ) this.position.y =  _height;
					if ( this.position.z >  _depth ) this.position.z = - _depth;
					if ( this.position.z < - _depth ) this.position.z =  _depth;

				}

				//

				this.avoid = function ( target ) {

					var steer = new THREE.Vector3();

					steer.copy( this.position );
					steer.sub( target );

					steer.multiplyScalar( 1 / this.position.distanceToSquared( target ) );

					return steer;

				}

				this.repulse = function ( target ) {

					var distance = this.position.distanceTo( target );

					if ( distance < 150 ) {

						var steer = new THREE.Vector3();

						steer.subVectors( this.position, target );
						steer.multiplyScalar( 0.5 / distance );

						_acceleration.add( steer );

					}

				}

				this.reach = function ( target, amount ) {

					var steer = new THREE.Vector3();

					steer.subVectors( target, this.position );
					steer.multiplyScalar( amount );

					return steer;

				}

				this.alignment = function ( boids ) {

					var boid, velSum = new THREE.Vector3(),
					count = 0;

					for ( var i = 0, il = boids.length; i < il; i++ ) {

						if ( Math.random() > 0.6 ) continue;

						boid = boids[ i ];

						distance = boid.position.distanceTo( this.position );

						if ( distance > 0 && distance <= _neighborhoodRadius ) {

							velSum.add( boid.velocity );
							count++;

						}

					}

					if ( count > 0 ) {

						velSum.divideScalar( count );

						var l = velSum.length();

						if ( l > _maxSteerForce ) {

							velSum.divideScalar( l / _maxSteerForce );

						}

					}

					return velSum;

				}

				this.cohesion = function ( boids ) {

					var boid, distance,
					posSum = new THREE.Vector3(),
					steer = new THREE.Vector3(),
					count = 0;

					for ( var i = 0, il = boids.length; i < il; i ++ ) {

						if ( Math.random() > 0.6 ) continue;

						boid = boids[ i ];
						distance = boid.position.distanceTo( this.position );

						if ( distance > 0 && distance <= _neighborhoodRadius ) {

							posSum.add( boid.position );
							count++;

						}

					}

					if ( count > 0 ) {

						posSum.divideScalar( count );

					}

					steer.subVectors( posSum, this.position );

					var l = steer.length();

					if ( l > _maxSteerForce ) {

						steer.divideScalar( l / _maxSteerForce );

					}

					return steer;

				}

				this.separation = function ( boids ) {

					var boid, distance,
					posSum = new THREE.Vector3(),
					repulse = new THREE.Vector3();

					for ( var i = 0, il = boids.length; i < il; i ++ ) {

						if ( Math.random() > 0.6 ) continue;

						boid = boids[ i ];
						distance = boid.position.distanceTo( this.position );

						if ( distance > 0 && distance <= _neighborhoodRadius ) {

							repulse.subVectors( this.position, boid.position );
							repulse.normalize();
							repulse.divideScalar( distance );
							posSum.add( repulse );

						}

					}

					return posSum;

				}

			}


			var SCREEN_WIDTH = window.innerWidth,
			SCREEN_HEIGHT = window.innerHeight,
			SCREEN_WIDTH_HALF = SCREEN_WIDTH  / 2,
			SCREEN_HEIGHT_HALF = SCREEN_HEIGHT / 2;

			var camera, scene, renderer,
			birds, bird;

			var boid, boids;

			var stats;

			init();
			animate();

			function init() {

				camera = new THREE.PerspectiveCamera( 75, SCREEN_WIDTH / SCREEN_HEIGHT, 1, 10000 );
				camera.position.z = 450;

				scene = new THREE.Scene();
				scene2 = new THREE.Scene();

				birds = [];
				boids = [];
				var yeah = "40";
				if(window.innerWidth<900) { var yeah= "5"; } else { var yeah= "40"; }
				for ( var i = 0; i < yeah; i ++ ) {

					boid = boids[ i ] = new Boid();
					boid.position.x = Math.random() * 400 - 200;
					boid.position.y = Math.random() * 400 - 200;
					boid.position.z = Math.random() * 400 - 200;
					boid.velocity.x = Math.random() * 2 - 1;
					boid.velocity.y = Math.random() * 2 - 1;
					boid.velocity.z = Math.random() * 2 - 1;
					boid.setAvoidWalls( true );
					boid.setWorldSize( 500, 500, 400 );

					bird = birds[ i ] = new THREE.Mesh( new Bird(), new THREE.MeshBasicMaterial( { color:Math.random() * 0xffffff, side: THREE.DoubleSide } ) );
					bird.phase = Math.floor( Math.random() * 62.83 );
					scene.add( bird );
					}


			    renderer = new THREE.CanvasRenderer({ alpha: true });
				renderer.setClearColor( 0x000000,0 );
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( SCREEN_WIDTH, SCREEN_HEIGHT );
				document.addEventListener( 'mousemove', onDocumentMouseMove, false );
				document.body.appendChild( renderer.domElement );
				renderer.domElement.style.zIndex="3";

			/*		stats = new Stats();
				stats.domElement.style.position = 'absolute';
				stats.domElement.style.left = '0px';
				stats.domElement.style.top = '0px';

				document.getElementById( 'container' ).appendChild(stats.domElement); */

				//

				window.addEventListener( 'resize', onWindowResize, false );

			}

			function onWindowResize() {

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

			}

			function onDocumentMouseMove( event ) {

				var vector = new THREE.Vector3( event.clientX - SCREEN_WIDTH_HALF, - event.clientY + SCREEN_HEIGHT_HALF, 0 );

				for ( var i = 0, il = boids.length; i < il; i++ ) {

					boid = boids[ i ];

					vector.z = boid.position.z;

					boid.repulse( vector );

				}

			}

			//

			function animate() {

				requestAnimationFrame( animate );

				render();


			}

			function render() {

				for ( var i = 0, il = birds.length; i < il; i++ ) {

					boid = boids[ i ];
					boid.run( boids );

					bird = birds[ i ];
					bird.position.copy( boids[ i ].position );

					color = bird.material.color;
					color.r = color.g = color.b = ( 500 - bird.position.z ) / 1000;

					bird.rotation.y = Math.atan2( - boid.velocity.z, boid.velocity.x );
					bird.rotation.z = Math.asin( boid.velocity.y / boid.velocity.length() );

					bird.phase = ( bird.phase + ( Math.max( 0, bird.rotation.z ) + 0.1 )  ) % 62.83;
					bird.geometry.vertices[ 5 ].y = bird.geometry.vertices[ 4 ].y = Math.sin( bird.phase ) * 5;

				}

				renderer.render( scene, camera );

			}


/*********************************************************************/
if(window.innerWidth>900) {
(function() {

  var canvas, ctx, circ, nodes, mouse, SENSITIVITY, SIBLINGS_LIMIT, DENSITY, NODES_QTY, ANCHOR_LENGTH, MOUSE_RADIUS;

  // how close next node must be to activate connection (in px)
  // shorter distance == better connection (line width)
  SENSITIVITY = 100;
  // note that siblings limit is not 'accurate' as the node can actually have more connections than this value that's because the node accepts sibling nodes with no regard to their current connections this is acceptable because potential fix would not result in significant visual difference 
  // more siblings == bigger node
  SIBLINGS_LIMIT = 5;
  // default node margin
  DENSITY = 50;
  // total number of nodes used (incremented after creation)
  NODES_QTY = 0;
  // avoid nodes spreading
  ANCHOR_LENGTH = 20;
  // highlight radius
  MOUSE_RADIUS = 100;

  circ = 2 * Math.PI;
  nodes = [];

  canvas = document.getElementById('canvas-nodes');
  resizeWindow();
  mouse = {
    x: canvas.width / 2,
    y: canvas.height / 2
  };
  ctx = canvas.getContext('2d');
  if (!ctx) {
	document.getElementsByClassName("container").style.background = "url(img/bg.jpg)";
  }

  function Node(x, y) {
    this.anchorX = x;
    this.anchorY = y;
    this.x = Math.random() * (x - (x - ANCHOR_LENGTH)) + (x - ANCHOR_LENGTH);
    this.y = Math.random() * (y - (y - ANCHOR_LENGTH)) + (y - ANCHOR_LENGTH);
    this.vx = Math.random() * 2 - 1;
    this.vy = Math.random() * 2 - 1;
    this.energy = Math.random() * 100;
    this.radius = Math.random();
    this.siblings = [];
    this.brightness = 0;
  }

  Node.prototype.drawNode = function() {
    var color = "rgba(0, 0, 0, " + this.brightness + ")";
    ctx.beginPath();
    ctx.arc(this.x, this.y, 2 * this.radius + 2 * this.siblings.length / SIBLINGS_LIMIT, 0, circ);
    ctx.fillStyle = color;
    ctx.fill();
  };

  Node.prototype.drawConnections = function() {
    for (var i = 0; i < this.siblings.length; i++) {
      var color = "rgba(20, 20, 20, " + this.brightness + ")";
      ctx.beginPath();
      ctx.moveTo(this.x, this.y);
      ctx.lineTo(this.siblings[i].x, this.siblings[i].y);
      ctx.lineWidth = 1 - calcDistance(this, this.siblings[i]) / SENSITIVITY;
      ctx.strokeStyle = color;
      ctx.stroke();
    }
  };

  Node.prototype.moveNode = function() {
    this.energy -= 2;
    if (this.energy < 1) {
      this.energy = Math.random() * 100;
      if (this.x - this.anchorX < -ANCHOR_LENGTH) {
        this.vx = Math.random() * 2;
      } else if (this.x - this.anchorX > ANCHOR_LENGTH) {
        this.vx = Math.random() * -2;
      } else {
        this.vx = Math.random() * 4 - 2;
      }
      if (this.y - this.anchorY < -ANCHOR_LENGTH) {
        this.vy = Math.random() * 2;
      } else if (this.y - this.anchorY > ANCHOR_LENGTH) {
        this.vy = Math.random() * -2;
      } else {
        this.vy = Math.random() * 4 - 2;
      }
    }
    this.x += this.vx * this.energy / 100;
    this.y += this.vy * this.energy / 100;
  };

  function initNodes() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    nodes = [];
    for (var i = DENSITY; i < canvas.width; i += DENSITY) {
      for (var j = DENSITY; j < canvas.height; j += DENSITY) {
        nodes.push(new Node(i, j));
        NODES_QTY++;
      }
    }
  }

  function calcDistance(node1, node2) {
    return Math.sqrt(Math.pow(node1.x - node2.x, 2) + (Math.pow(node1.y - node2.y, 2)));
  }

  function findSiblings() {
    var node1, node2, distance;
    for (var i = 0; i < NODES_QTY; i++) {
      node1 = nodes[i];
      node1.siblings = [];
      for (var j = 0; j < NODES_QTY; j++) {
        node2 = nodes[j];
        if (node1 !== node2) {
          distance = calcDistance(node1, node2);
          if (distance < SENSITIVITY) {
            if (node1.siblings.length < SIBLINGS_LIMIT) {
              node1.siblings.push(node2);
            } else {
              var node_sibling_distance = 0;
              var max_distance = 0;
              var s;
              for (var k = 0; k < SIBLINGS_LIMIT; k++) {
                node_sibling_distance = calcDistance(node1, node1.siblings[k]);
                if (node_sibling_distance > max_distance) {
                  max_distance = node_sibling_distance;
                  s = k;
                }
              }
              if (distance < max_distance) {
                node1.siblings.splice(s, 1);
                node1.siblings.push(node2);
              }
            }
          }
        }
      }
    }
  }

  function redrawScene() {
    resizeWindow();
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    findSiblings();
    var i, node, distance;
    for (i = 0; i < NODES_QTY; i++) {
      node = nodes[i];
      distance = calcDistance({
        x: mouse.x,
        y: mouse.y
      }, node);
      if (distance < MOUSE_RADIUS) {
        node.brightness = 1 - distance / MOUSE_RADIUS;
      } else {
        node.brightness = 0;
      }
    }
    for (i = 0; i < NODES_QTY; i++) {
      node = nodes[i];
      if (node.brightness) {
        node.drawNode();
        node.drawConnections();
      }
      node.moveNode();
    }
    requestAnimationFrame(redrawScene);
  }

  function initHandlers() {
    document.addEventListener('resize', resizeWindow, false);
    canvas.addEventListener('mousemove', mousemoveHandler, false);
  }

  function resizeWindow() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }

  function mousemoveHandler(e) {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
  }

  initHandlers();
  initNodes();
  redrawScene();

})();
}
/**********************************************************************/

jQuery(document).ready(function($){
var main_color = 0xffffff;

var canvas_height = window.innerHeight;
var canvas_width = window.innerWidth;
//////////////////////////////////////////
    //   Scene
//////////////////////////////////////////
var scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2( main_color, 0.0085 );

//////////////////////////////////////////
    //   Camera
//////////////////////////////////////////
var camera = new THREE.PerspectiveCamera( 75, canvas_width/canvas_height, 0.1, 1000 );
    camera.lookAt(new THREE.Vector3(0,50,0));
    camera.position.set(0,50,200);
//////////////////////////////////////////
    //   Renderer
//////////////////////////////////////////
var renderer = new THREE.WebGLRenderer({ alpha: true }); /// { alpha: true }
    renderer.setSize( canvas_width, canvas_height );
    renderer.shadowMapEnabled = true;
    renderer.shadowMapType = THREE.PCFSoftShadowMap;
    renderer.setClearColor(main_color,1);
$('body').append( renderer.domElement );


//////////////////////////////////////////
    //   Resize
//////////////////////////////////////////
window.onresize = function(){
  canvas_height = window.innerHeight;
  canvas_width = window.innerWidth;
  camera.aspect = canvas_width / canvas_height;
  camera.updateProjectionMatrix();
  renderer.setSize( canvas_width, canvas_height );
}
//////////////////////////////////////////
    //   Controls
//////////////////////////////////////////

controls = new THREE.OrbitControls( camera );
controls.damping = 0.2;
controls.maxPolarAngle = 0;
controls.minPolarAngle = 0;
controls.minDistance = 100;
controls.maxDistance = 220;
controls.enabled = false;
//////////////////////////////////////////
    //    Light
//////////////////////////////////////////
var spotLight = new THREE.SpotLight(0xffffff);
    spotLight.position.set( 0, 100, 100 );
    spotLight.intensity = 1;
    spotLight.castShadow = true;
    scene.add(spotLight);

//////////////////////////////////////////
    //    Terrain Geometry
//////////////////////////////////////////

function terrain_obj(){
  this.terrain_geometry =  new THREE.PlaneGeometry(canvas_width * 2,canvas_height*2, 64,64);
  this.terrain_material = new THREE.MeshLambertMaterial({
	  color: main_color

	});
  this.terrain_wire_material = new THREE.MeshLambertMaterial({
	  color: 0x555555,
	  wireframe: true,
	  transparent: true
	});
  this.terrain_wire = null;
  this.generate = function(){
     for(var i=0;i<this.terrain_geometry.vertices.length;i++){
        this.terrain_geometry.vertices[i].z = Math.random() * 15;
     }
   this.terrain =  new THREE.Mesh(this.terrain_geometry,this.terrain_material);
   this.terrain_top =  new THREE.Mesh(this.terrain_geometry.clone(),this.terrain_material);
   this.terrain_wire =  new THREE.Mesh(this.terrain_geometry.clone(),this.terrain_wire_material);
   this.terrain.rotation.x = -Math.PI / 2;
   this.terrain.position.y = -20;
    


   this.terrain_top.rotation.x = Math.PI / 2;
   this.terrain_top.position.y = 120;
    
   this.terrain_wire.rotation.x = -Math.PI / 2;
   this.terrain_wire.position.y = -17.9;
   this.terrain.receiveShadow = true;
   this.terrain.castShadow = true;

   scene.add(this.terrain,this.terrain_wire,this.terrain_top);
   return this;
  };
  this.generate();
}
var terrain_bottom = terrain_obj();



var loader = new THREE.JSONLoader();
var material_options = {
  emissive : 0xffffff,
  color: 0x666666,
  opacity: .5,
 // transparent:true
}
var wire_material_options = {
  wireframe : true,
  wireframeLinewidth :2,
  color : 0xffffff
}



//////////////////////////////////////////
    //   Render
//////////////////////////////////////////
var render = function () { 
  requestAnimationFrame( render ); 
  animation();
  renderer.render(scene, camera);
};
//////////////////////////////////////////
    //    Animation
//////////////////////////////////////////
function animation(){
  scene.rotation.y  -= .0005;
}
//////////////////////////////////////////
    //    Start scene
//////////////////////////////////////////
render(); 


});