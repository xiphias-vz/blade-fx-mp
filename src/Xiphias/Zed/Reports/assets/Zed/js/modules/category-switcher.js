'use strict';

import settings from './category-switcher-configuration';
import $ from 'jquery/dist/jquery';

export default class CategorySwitcher {
    state = {
        categories: [],
        activeCategory: null
    }

    init() {
        const categories = document.querySelectorAll(`.${this.getCategoryListItemClass}`)

        this.initializeState(categories);
        this.initializeListeners();
    }

    initializeListeners() {
        this.initializeCategoryListeners();
    }

    initializeCategoryListeners() {
        if(this.state.categories[-1]) {
            this.state.categories[-1].addEventListener('click', e => {
                this.changeActiveCategory(this.getCategoryId(this.state.categories[-1]))
            })
        }

        this.state.categories.forEach(category => {
            category.addEventListener('click', e => {
                this.changeActiveCategory(this.getCategoryId(category))
            })
        })
    }

    initializeState(categoryElements) {
        categoryElements.forEach(categoryElement => {
            let categoryId = parseInt(this.getCategoryId(categoryElement));
            let categoryActive = this.getCategoryActiveState(categoryElement);

            if(categoryActive === "1") {
                this.state.activeCategory = categoryId;
            }

            this.state.categories[categoryId] = categoryElement;
        })
    }

    getCategoryId(categoryElement) {
        return categoryElement.dataset.id;
    }

    getCategoryActiveState(categoryElement) {
        return categoryElement.dataset.active;
    }

    changeActiveCategory(id) {
        if(this.isActiveCategory(id)) return;

        this.toggleActiveCategoryUI(this.getActiveCategory(), id);
        this.setActiveCategory(id);
        this.switchCategory();
    }

    isActiveCategory(id) {
        return id === this.getActiveCategory();
    }

    switchCategory() {
        const currentPath = window.location;
        const queryParams = new URLSearchParams(currentPath.search)

        queryParams.set('category', this.getActiveCategory())

        window.location =  currentPath.pathname + '?' + queryParams.toString()
    }

    setActiveCategory(id) {
        this.state.activeCategory = id;
    }

    toggleActiveCategoryUI(oldCategoryId, newCategoryId) {
        this.state.categories[oldCategoryId].classList.toggle(this.getCategoryListItemActiveClass)
        this.state.categories[newCategoryId].classList.toggle(this.getCategoryListItemActiveClass)
    }

    getActiveCategory() {
        return this.state.activeCategory;
    }

    get getCategoryListItemClass(){
        return settings.CATEGORY_LIST_ITEM_CLASS;
    }
    get getCategoryListItemActiveClass(){
        return settings.CATEGORY_LIST_ITEM_ACTIVE_CLASS;
    }
}

