<style>
	.modal-dialog {
	    width: 800px;
	    margin: 30px auto;
	    font-family:'Open Sans','Helvetica','Arial';
	}
	@media only screen and (max-width: 768px) {
		.modal-dialog {
		    width: 500px;
		}
	}
	@media only screen and (max-width: 479px) {
		.modal-dialog {
		    width: 300px;
		}
	}
	.modal-content ul
	{
		list-style: none;
	}
	.modal-footer p{
		font-size:10px;
		line-height: 1.2em;
		color:#727272;
		text-align: left;
	}
	.modal-footer {
		padding-top:5px;
	}
	.subratllat {
		text-decoration: underline;
		margin-bottom: 0.3em !important;
		
	}
	.conditions p {
		font-size:10px;
		margin-top: 0.2em;
		margin-bottom: 0.7em;
	}
	.conditions_title {
		font-weight: 700;
		margin-bottom:0.3em;
		color: #333;
	}
	.btn_suscribete {
		text-decoration: none;
		font-weight: bold;
		color:#ffffff;
		text-align: center;
		letter-spacing: 0px;
		background-color: #E8076F;
		font-size:14px;
		font-family:'Open Sans','Helvetica','Arial';
	}
	.modal-left {
		background-color:#E8076F;
		padding:15px;	
	}
	.modal-left p, .modal-right p {
		margin: 0px;
	}
	.modal-right {
		text-align: center;
		padding:15px;	
	}
	.icon_user {
		font-weight: 600;
		font-size:60px;
		color:white;
	}
	.icon_sobre {
		color:#E8076F;
		font-weight: 600;
		font-size:60px;
	}
	.center {
		text-align: center;
	}
	.texto_left {
		font-size:12px;
		color:white;
		line-height: 1.6;
		text-align: justify;
	}
	.texto_left2 {
		font-size: 14px;
		padding:10px;
	}
	.modal-left h4 {
		color:white;

	}
	.modal-right h4 {
		font-weight: 600;
	}
	.condiciones{
		color:#282828;
		font-size:10px;		
		font-weight: 600;
    	line-height: 1.3;
	}
	.email_newsletter {
		line-height: 1.8;
	}
	.social-icon img{
		transition: 0.2s ease;
		}
	.social-icon img:hover {		
		-webkit-transform: scale(1.2);
		-ms-transform: scale(1.2);
		transform: scale(1.2);
		transition: 0.2s ease;
	}
	.social-icon:hover {
		text-decoration: none;
	}
	.link_modal {
		color: #888888;
	}
	.link_modal:hover {
		text-decoration:none;
	}


</style>


<!-- Modal -->
<?php


$usuario = $this->Session->read('User.logged');


$listaEmails = explode(';',str_replace(',',';',str_replace(' ','',$usuario['email'])));



$url = $this->get('urlActual');
?>
<div id="subscribeModal" class="modal left fade" role="dialog" tabindex="-1"  >
	<div class="modal-dialog" >
		<div class="modal-content ">
        	
            <div class="modal-body">
            	<div class="row">
            		<div class="col-md-12">
            			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            		</div>
            	</div>
            	<div class="row">
            		<div class="col-md-6 col-sm-6">
            			<div class="modal-left">
	            			<p class="center"><i class="fa fa-user-o icon_user" aria-hidden="true"></i></p>
	            			<br />
			            	<h4><?=__('Bienvenido/a,');?></h4>
		            	    <p class="texto_left"><?=__('Corma SCCL le informa que trata sus datos con el fin de informarles de sus productos y servicios.');?></p>
		            	    <p class="texto_left2 center"><strong><?=__('¡Queremos seguir haciéndolo!');?></strong></p>

					        <p class="texto_left"><?=__('El nuevo Reglamento General de Protección de Datos (Reglamento (UE) 2016/679) exige disponer del consentimiento explícito para esta clase de tratamiento de datos. Por este motivo le solicitamos que, en caso de que estén interesados en seguir figurando en nuestra lista de distribución de información, nos lo confirme.');?></p>
				        
				        	<hr />

							<p class="condiciones subratllat"><?=__('Información básica de protección de datos personales');?></p>


							<p class="condiciones"><?=__('Responsable del tratamiento: Corma SCCL, Camí del mig, 20, de Premià de Dalt (CP 08338). Tel. 937549000, corma@corma.es.');?></p>
							<p class="condiciones"><?=__('Finalidad: envío de información de Corma.');?></p>
							<p class="condiciones"><?=__('Legitimación: consentimiento de la persona interesada. La persona interesada puede revocar el consentimiento en cualquier momento.');?></p>
							<p class="condiciones"><?=__('Destinatarios: no se comunican datos a otras personas.');?></p>
							<p class="condiciones"><?=__('Derechos de las personas interesadas: puede ejercer los derechos de acceso, rectificación, supresión, oposición al tratamiento y solicitud de limitación, dirigiéndose a Corma.');?></p>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="modal-right">
		        			<p class="center"><i class="fa fa-envelope-o icon_sobre" aria-hidden="true"></i></p>

		        			<br />
		        			<h4><?=__('¡Suscríbete a nuestras newsletters para estar al dia de las últimas novedades y promociones!');?></h4>
							<div class="formulario">					    
			        			<?php 
					            echo $this->Form->create('UsersNewsletters', array('url'=>array( 'action'=>'subscribe')));
					            echo $this->Form->hidden('cliente',['value' => $usuario['code']]);

					      
					            foreach ($listaEmails as $email) {
					            	echo "<p class='email_newsletter'>".$email."</p>";
					            }
					            
					            ?>
					            
					            <br />
					            <div class='form-group'>
					            	<input type="hidden" name="data[UsersNewsletters][confirma_rgpd]" id="UsersNewslettersConfirmaRgpd_" value="0">
					            	<input type="checkbox" name="data[UsersNewsletters][confirma_rgpd]" class="form-group" value="1" id="UsersNewslettersConfirmaRgpd" required>
					            	<a href='#' data-toggle='modal' class='link_modal' data-target='#condicionesModal'><?=__('  Acepto las condiciones');?></a>
					            </div>
					            <div class='form-group'>
					            	<?php echo $this->Form->button(__('¡SUSCRÍBETE!'),['class' => 'form-control btn_suscribete']);?>
					            </div>
					            <?php echo $this->Form->end();?>


					        </div>
							<p class="center"><a href="<?=$url;?>/UsersNewsletters/unsubscribe/" class="link_modal"><?=__('No quiero recibir información comercial de Corma');?></a>

					        <br /><br /><br />
					        <p class="center" style="color: #333;font-weight:600;">
					        	<?=__('Descubre otras formas de conectar con Corma');?>
					        </p>
					        <br />
					        <div class="center">							
					        	<a href="https://ca-es.facebook.com/cormasccl/" target="_blank" class="social-icon">
									<?php echo $this->Html->image('facebook.png');?>
								</a>
								<a href="https://twitter.com/cormasccl" target="_blank" class="social-icon">
									<?php echo $this->Html->image('twitter.png');?>
								</a>
								<a href="https://www.youtube.com/channel/UCNTLxyocYmpwhmHPE0V_5cw" target="_blank" class="social-icon">
									<?php echo $this->Html->image('youtube.png');?>
								</a>
								<a href="https://www.instagram.com/corma_sccl/" target="_blank" class="social-icon">
									<?php echo $this->Html->image('instagram.png');?>
								</a>
								<a href="https://es.linkedin.com/company/corma-sccl" target="_blank" class="social-icon">
									<?php echo $this->Html->image('linkedin.png');?>
								</a>
								<a href="https://www.pinterest.es/corma_sccl/" target="_blank" class="social-icon">
									<?php echo $this->Html->image('pinterest.png');?>
								</a>
					        </div>

					    </div>
				    </div>
				    
	        	</div>
	    	</div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->



<div class="modal fade" id="condicionesModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="overflow-y: initial !important;">

    <div class="modal-content">
      <div class="modal-header">
      	
  		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  		<h5 class="modal-title"><strong><?=__('POLÍTICA DE PROTECCIÓN DE DATOS');?></strong></h5>
  	</div>

      <div class="modal-body conditions" style="height:520px;overflow-y: auto;">
		<p><?=__('Esta es la política de protección de datos de Cooperativa de Plantes Ornamentals del Maresme SCCL. Hace referencia a los datos que trata en el ejercicio de sus actividades comerciales dando cumplimiento al Reglamento General de Protección de Datos (Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016).');?></p>
		 	
		<p class="conditions_title"><?=__('¿Quién es el responsable del tratamiento de los datos personales?');?></p>
		<p><?=__('El responsable del tratamiento de los datos personales es Cooperativa de Plantas Ornamentales del Maresme SCCL (en adelante, CORMA), con CIF F08668824 inscrita en el Registro de Cooperativas con el número BN-1212, domicilio en Premià de Dalt 08338 Barcelona, ​​teléfono 937549000, dirección electrónica corma@corma.es y página web www.corma.es');?></p>
		<p><?=__('CORMA es parte integrante del grupo CLADE del que forman parte también Abacus Cooperativa, Blanquerna-URL, Comunidad Minera Olesana, Cooperativa Plana de Vic, Escola Sant Gervasi, SOM, Lavola, Orquesta Sinfónica del Vallés y Suara Cooperativa (más información sobre el grupo a www.grupclade.com).');?></p>

		<p class="conditions_title"><?=__('¿Con qué finalidad tratamos los datos?');?></p>
		<p><?=__('A CORMA tratamos los datos personales para las siguientes finalidades.');?></p>
		<p class="subratllat"><?=__('Contacto.');?></p>
		<p><?=__('Atender las consultas de las personas que contactan con nosotros por medio de formularios de contacto de nuestra página web. Los utilizamos únicamente para esta finalidad.');?></p>
		<p class="subratllat"><?=__('Atención telefónica');?></p>
		<p><?=__('Atender telefónicamente las personas que se ponen en contacto con nosotros por esta vía. Para ofrecer más calidad en el servicio las conversaciones pueden registrarse telefónicamente advirtiendo previamente a la persona con quien se comunicamos.');?></p>
		<p class="subratllat"><?=__('Selección de personal');?></p>
		<p><?=__('Recepción de currículum vitae que nos dirigen interesados ​​en trabajar con nosotros y gestión de los datos personales que se generan por la participación en los procesos de selección de personal, con el fin de analizar la adecuación del perfil de los candidatos en función de los lugares vacantes o de nueva creación. Nuestro criterio es conservar durante un plazo máximo de un año también los datos de las personas que no terminen siendo contratadas, por si a corto plazo se produce una nueva vacante o nuevo puesto de trabajo. No obstante, en este último caso, eliminamos inmediatamente los datos si el interesado nos lo pide.');?></p>
		<p class="subratllat"><?=__('Servicios a los clientes');?></p>
		<p><?=__('Registrar los nuevos clientes y los datos adicionales que se puedan generar como resultado de la relación comercial con los clientes. En el proceso de contratación se piden los datos imprescindibles, entre las que deben figurar datos bancarios (número de cuenta corriente o de tarjeta de crédito) que serán comunicados a entidades bancarias que gestionan el cobro (únicamente los pueden utilizar con este fin). La relación comercial conlleva otros tratamientos, como incorporar los datos a la contabilidad, la facturación o información a la administración tributaria. Accediendo al área de clientes de nuestra web es posible gestionar los datos propios, contratar productos, consultar el consumo y la facturación, acceder a promociones y descuentos o conocer el estado de consultas y reclamaciones que se hayan hecho por medio de este canal. El acceso al área de clientes nos proporciona información de la actividad del usuario de este servicio.');?></p>
		<p class="subratllat"><?=__('Servicios a los socios');?></p>
		<p><?=__('Registrar los datos de los socios de la cooperativa y los datos adicionales que se puedan generar como resultado de su participación en la cooperativa. Los datos se utilizan para organizar los servicios, para informar a los socios de las iniciativas de la cooperativa, convocarlos a actos o en las reuniones preceptivas e informarles de los productos o servicios.');?></p>
		<p class="subratllat"><?=__('Información de nuestros productos y servicios');?></p>
		<p><?=__('Mientras existe relación contractual con sus clientes CORMA SCCL utiliza sus datos de contacto para comunicar información propia de esta relación, información que podrá circunstancialmente incluir referencias de nuestros productos o servicios, ya sean de carácter general o referidos más específicamente a las características y necesidades del cliente.');?></p>
		<p class="subratllat"><?=__('Otra información de productos y servicios');?></p>
		<p><?=__('Con la autorización explícita de los clientes, terminada la relación contractual los datos de contacto se conservan para enviar publicidad relacionada con nuestros servicios o productos, información de carácter general o específica por las características del cliente. Esta información se hace llegar a quien, a pesar de no haber sido cliente, nos lo pide o lo acepta llenando nuestros formularios.');?></p>
		<p class="subratllat"><?=__('Publicidad de productos y servicios de empresas de nuestro grupo');?></p>
		<p><?=__('Siempre con la autorización previa y explícita de las personas indicadas en el apartado anterior, los datos de contacto sirven para hacer llegar publicidad, tanto de carácter general como adaptada a las características de la persona, información de productos o servicios de las empresas del nuestro grupo. Asimismo, con el consentimiento explícito del interesado, los datos de contacto se podrán comunicar a estas empresas para que estas empresas puedan enviar directamente publicidad de sus productos o servicios.');?></p>
		<p class="subratllat"><?=__('Gestión de los datos de nuestros proveedores');?></p>
		<p><?=__('Registramos y tratamos los datos de los proveedores de quien obtenemos servicios o bienes. Pueden ser los datos de personas que actúan como autónomos y también datos de representantes de personas jurídicas. Obtenemos los datos imprescindibles para mantener la relación comercial, los destinamos únicamente a este fin y hacemos el uso propio de esta clase de relación.');?></p>
		<p class="subratllat"><?=__('Videovigilancia');?></p>
		<p><?=__('En el acceso a nuestras instalaciones informa, cuando es el caso, de la existencia de cámaras de videovigilancia mediante los rótulos homologados. Las cámaras graban imágenes sólo de los puntos en los que es justificado para garantizar la seguridad de los bienes y de las personas y las imágenes se utilizan únicamente para esta finalidad.');?></p>
		<p class="subratllat"><?=__('Usuarios de nuestra web');?></p>
		<p><?=__('El sistema de navegación y el software que posibilita el funcionamiento de nuestra web recogen los datos que ordinariamente se generan en el uso de los protocolos de Internet. En esta categoría de datos hay entre otros la dirección IP o nombre de dominio del ordenador utilizado por la persona que se conecta al sitio web. Nuestra web utiliza galletas (cookies) que permiten la identificación de personas físicas concretas, usuarias del sitio. Puede leer más información sobre el uso de las cookies desde este enlace.');?></p>
		<p class="subratllat"><?=__('Otros canales de obtención de datos');?></p>
		<p><?=__('Obtenemos también datos por medio de relaciones presenciales y otros canales como la recepción de correos electrónicos o por medio de nuestros perfiles en las redes sociales. En todos los casos los datos se destinan sólo a los fines explícitas que justifican la recogida y tratamiento.');?></p>

		<p class="conditions_title"><?=__('¿Cuál es la legitimación legal para el tratamiento de los datos?');?></p>
		<p><?=__('Los tratamientos de datos que llevamos a cabo tienen diferentes fundamentos legales, según la naturaleza de cada tratamiento.');?></p>
		<p class="subratllat"><?=__('En cumplimiento de una relación precontractual.');?></p>
		<p><?=__('Caso de los datos de posibles clientes o proveedores con los que tenemos relaciones previas a la formalización de una relación contractual, como la elaboración o el estudio de presupuestos). Es también el caso del tratamiento de datos de personas que nos han hecho llegar sus currículum vitae o que participan en procesos selectivos.');?></p>
		<p class="subratllat"><?=__('En cumplimiento de una relación contractual.');?></p>
		<p><?=__('Caso de las relaciones con nuestros clientes y proveedores y todas las actuaciones y usos que estas relaciones conllevan.');?></p>
		<p class="subratllat"><?=__('En cumplimiento de obligaciones legales.');?></p>
		<p><?=__('Las comunicaciones de datos a la administración tributaria viene establecida por normas reguladoras de las relaciones comerciales. Puede producirse el caso de tener que comunicar datos a órganos judiciales o en cuerpos y fuerzas de seguridad también en cumplimiento de normas legales que obligan a colaborar con estos estamentos públicos.');?></p>
		<p class="subratllat"><?=__('En base al consentimiento.');?></p>
		<p><?=__('Cuando hacemos envíos de información de nuestros productos o servicios tratamos los datos de contacto de los receptores con su autorización o consentimiento explícito. Los datos de navegación que podamos obtener mediante cookies los obtenemos con el consentimiento de la persona que visita nuestra web, consentimiento que puede revocar en cualquier momento desinstalando estas cookies. También es con el consentimiento previo de cada persona que comunicamos sus datos a otras empresas de nuestro grupo.');?></p>
		<p class="subratllat"><?=__('Por interés legítimo.');?></p>
		<p><?=__('Las imágenes que obtenemos con las cámaras de videovigilancia se tratan por el interés legítimo de nuestra empresa de preservar sus bienes e instalaciones. Nuestro interés legítimo justifica también el tratamiento de datos que obtenemos de los formularios de contacto, así como las de las personas que se registran para comentar en nuestras redes sociales.');?></p>

		<p class="conditions_title"><?=__('¿A quién se comunican los datos?');?></p>
		<p><?=__('Como criterio general únicamente comunicamos datos a administraciones o poderes públicos y siempre en cumplimientos de obligaciones legales. En la emisión de facturas a clientes los datos se pueden comunicar a entidades bancarias. En casos justificados comunicaremos los datos a los cuerpos y fuerzas de seguridad o los órganos judiciales competentes. Por otra parte, en caso de que se haya dado el consentimiento, los datos podrán ser comunicados a otras empresas de nuestro grupo para las finalidades indicadas anteriormente. No se hacen transferencias de datos fuera del ámbito de la Unión Europea (transferencia internacional).');?></p>
		<p><?=__('En un otros sentido, para determinadas tareas obtenemos los servicios de empresas o personas que nos aportan su experiencia y especialización. En algunas ocasiones estas empresas externas deben acceder a datos personales de nuestra responsabilidad. No se trata propiamente de una cesión de datos sino de un encargo de tratamiento. Únicamente se contratan servicios de empresas que garantizan el cumplimiento de la normativa de protección de datos. En el momento de la contratación se formalizan sus obligaciones de confidencialidad y se hace un seguimiento de su actuación. Puede ser el caso de servicios de alojamiento, de servicios de soporte informático o de asesorías jurídicas, contables o fiscales.');?></p>

		<p class="conditions_title"><?=__('¿Cuánto tiempo conservamos los datos?');?></p>
		<p><?=__('Cumplimos la obligación legal de limitar al máximo el plazo de conservación de los datos. Por este motivo se conservan sólo el tiempo necesario y justificado por la finalidad que motivó la obtención. En determinados casos, como los datos que figuran en la documentación contable y la facturación, la normativa fiscal obliga a conservarlas hasta que no prescriban las responsabilidades en esta materia. En el caso de los datos que se tratan en base al consentimiento de la persona interesada, se conservan hasta que esta persona no revoca este consentimiento. Las imágenes obtenidas por las cámaras de videovigilancia se conservan como máximo durante un mes, si bien en el caso de incidentes que lo justifiquen se conservarán el tiempo necesario para facilitar las actuaciones de los cuerpos y fuerzas de seguridad o de los órganos judiciales.');?></p>

		<p class="conditions_title"><?=__('¿Qué derechos tienen las personas en relación a los datos que tratamos?');?></p>
		<p><?=__('Tal como prevé el Reglamento General de Protección de Datos, las personas de quienes tratamos datos tienen los siguientes derechos:');?>

		<p class="subratllat"><?=__('A saber si se tratan.');?></p>
		<p><?=__('Cualquier persona tiene, en primer lugar, derecho a saber si nosotros tratamos sus datos, con independencia de si ha existido una relación previa.');?></p>

		<p class="subratllat"><?=__('A ser informado en la recogida.');?></p>
		<p><?=__('Cuando los datos personales se obtienen del propio interesado, en el momento de proporcionarles las debe tener información clara de las finalidades a las que se destinarán, de quién será el responsable del tratamiento y del resto de aspectos derivados de este tratamiento.');?></p>

		<p class="subratllat"><?=__('A acceder.');?></p>
		<p><?=__('Derecho muy amplio que incluye el de saber con precisión qué datos personales son objeto de tratamiento, cuál es la finalidad para la que se tratan, las comunicaciones a otras personas que se harán (en su caso) o el derecho a obtenerlo copia oa saber el plazo previsto de conservación.');?></p>

		<p class="subratllat"><?=__('A pedir su rectificación.');?></p>
		<p><?=__('Es el derecho a hacer rectificar los datos inexactos que sean objeto de tratamiento por parte nuestra.');?></p>

		<p class="subratllat"><?=__('A pedir su supresión.');?></p>
		<p><?=__('En determinadas circunstancias existe el derecho a pedir la supresión de los datos cuando, entre otros motivos, ya no sean necesarias para los fines para los que fueron recogidos y justificaron el tratamiento.');?></p>

		<p class="subratllat"><?=__('Pedir la limitación del tratamiento.');?></p>
		<p><?=__('También en determinadas circunstancias se reconoce el derecho a pedir la limitación del tratamiento de los datos. En este caso dejarán de ser tratadas y sólo se conservarán para el ejercicio o la defensa de reclamaciones, de acuerdo con el Reglamento General de Protección de Datos.');?></p>

		<p class="subratllat"><?=__('En la portabilidad.');?></p>
		<p><?=__('En los casos previstos en la normativa se reconoce el derecho a obtener los datos personales propios en un formato estructurado de uso común legible por máquina, y transmitirlas a otro responsable del tratamiento si así lo decide la persona interesada.');?></p>

		<p class="subratllat"><?=__('A oponerse al tratamiento.');?></p>
		<p><?=__('Una persona puede aducir motivos relacionados con su situación particular, motivos que comportarán que dejen de tratarse sus datos en el grado o medida que pueda suponer un perjuicio, excepto por motivos legítimos o el ejercicio o defensa ante reclamaciones.');?></p>

		<p class="subratllat"><?=__('A no recibir información comercial.');?></p>
		<p><?=__('Atenderemos inmediatamente las peticiones de no seguir enviando información comercial a las personas que previamente nos lo hubieran autorizado.');?></p>

		<p class="conditions_title"><?=__('¿Como se pueden ejercer o defender los derechos?');?></p>
		<p><?=__('Los derechos que acabamos de enumerar pueden ejercerse dirigiendo una solicitud escrita a CORMA SCCL a la dirección postal Camí del Mig, 20, de Premià de Dalt (CP 08338), o mediante el formulario electrónico disponible en www.corma.es, o bien enviando un correo electrónico a corma@corma.es, indicando en todos los casos “Protección de datos personales”.');?></p>
		<p><?=__('Si no se ha obtenido respuesta satisfactoria en el ejercicio de los derechos es posible presentar una reclamación ante la Agencia Española de Protección de Datos, por medio de los formularios u otros canales accesibles desde su página www.agpd.es.');?></p>
      </div>
      
    </div>
  </div>
</div>