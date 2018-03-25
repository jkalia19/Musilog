<form role="search" method="get" class="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
    <label>
        <input type="text" class="search-top"
            placeholder="<?php esc_attr_e( 'Search here..', 'muso' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php esc_attr_e( 'Search for:', 'muso' ) ?>" />
    </label>
    <input type="submit" class="Search"
        value="<?php esc_attr_e( 'Search', 'muso' ) ?>" />
</form>