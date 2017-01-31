<?php namespace Modules\Testimonial\Providers;

use Illuminate\Support\ServiceProvider;

class TestimonialServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Testimonial\Repositories\TestimonialRepository',
            function () {
                $repository = new \Modules\Testimonial\Repositories\Eloquent\EloquentTestimonialRepository(new \Modules\Testimonial\Entities\Testimonial());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Testimonial\Repositories\Cache\CacheTestimonialDecorator($repository);
            }
        );
// add bindings

    }
}
