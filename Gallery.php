<?php
namespace cmsgears\widgets\gallery;

// Yii Imports
use \Yii;
use yii\base\Widget;
use yii\helpers\Html;

class Gallery extends \cmsgears\core\common\base\Widget {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------
	/**
	 * The gallery name.
	 */
    public $name;

	/**
	 * The gallery slug.
	 */
    public $slug;

	/**
	 * The gallery. Name or slug not required in case gallery is provided.
	 */
	public $gallery;

	// Protected --------------

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// yii\base\Widget --------

	/**
	 * @inheritdoc
	 */
    public function run() {

		$galleryService = Yii::$app->factory->get( 'galleryService' );

		if( empty( $this->gallery ) && isset( $this->name ) ) {

			$this->gallery	= $galleryService->getByName( $this->name, true );
		}

		if( empty( $this->gallery ) && isset( $this->slug ) ) {

			$this->gallery	= $galleryService->getBySlug( $this->slug, true );
		}

        if( isset( $this->gallery ) && $this->gallery->active ) {

			$galleryHtml	= $this->renderWidget();

	        return Html::tag( 'div', $galleryHtml, $this->options );
		}
    }

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	public function renderWidget( $config = [] ) {

		$gallery		= $this->gallery;
		$items 			= [];
		$galleryHtml	= '';

		// Paths
		$wrapperPath	= $this->template . '/wrapper';
		$itemPath		= $this->template . '/item';

		// Generate Items Html

		$gitems = $gallery->files;

	    foreach( $gitems as $item ) {

	        $items[] = $this->render( $itemPath, [ 'item' => $item ] );
	    }

		$itemsHtml		= implode( "\n", $items );

		$galleryHtml	= $this->render( $wrapperPath, [ 'gallery' => $gallery, 'itemsHtml' => $itemsHtml ] );

		return $galleryHtml;
	}

	// Gallery -------------------------------
}