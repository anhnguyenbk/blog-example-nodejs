<template>

  <!-- Non-root render -->
  <li v-if="notRoot"
      :data-id="item.id">
    <template v-if="notRoot">
      <span class="pre-children">----</span>
      <span class="item-name">{{ item.name }}</span>
      <span v-if="isFolder" class="btn-action" @click="toggle">[{{ isOpen ? '-' : '+' }}]</span>
      &nbsp;&nbsp;

      <span v-if="!isFolder" class="btn-action d-inline-block" @click="$emit('add-item', item)">
        <CIcon name="cil-note-add"/>
      </span>
        <span class="btn-action d-inline-block" @click="$emit('edit-item', item)">
          <CIcon name="cil-pencil"/>
        </span>
          <span class="btn-action d-inline-block" @click="$emit('delete-item', item)">
          <CIcon name="cil-trash"/>
        </span>
    </template>

    <ul v-show="isOpen" v-if="isFolder">
      <draggable :list="item.children" group="categories"
                 @change="$emit('update-order', item)">
          <CategoriesTree
              class="item"
              v-for="(child, index) in item.children"
              :key="child.id"
              :item="child"
              notRoot=true
              @add-item="$emit('add-item', $event)"
              @edit-item="$emit('edit-item', $event)"
              @delete-item="$emit('delete-item', $event)"
              @update-order="$emit('update-order', $event)"
          ></CategoriesTree>
      </draggable>

      <li class="add" @click="$emit('add-item', item)">
        <span class="pre-children">----</span>&nbsp;
        <span class="btn-action"><CIcon name="cib-addthis"/></span>
      </li>
    </ul>
  </li>

  <!-- Root render -->
  <ul v-else class="categories-tree root">
    <draggable :list="item.children" group="categories"
               @change="$emit('update-order', item)">
        <CategoriesTree
            class="item"
            v-for="(child, index) in item.children"
            :key="index"
            :item="child"
            notRoot=true
            @add-item="$emit('add-item', $event)"
            @edit-item="$emit('edit-item', $event)"
            @delete-item="$emit('delete-item', $event)"
            @update-order="$emit('update-order', $event)"
        ></CategoriesTree>
    </draggable>

    <li class="add" @click="$emit('add-item', item)">
      <span class="pre-children">----</span>&nbsp;
      <span class="btn-action"><CIcon name="cib-addthis"/></span>
    </li>
  </ul>
</template>

<script>
import draggable from 'vuedraggable'
export default {
  name: "CategoriesTree",
  props: ['item', 'notRoot'],
  components: {
    draggable
  },
  data: function () {
    return {
      isOpen: true,
    };
  },
  computed: {
    isFolder: function () {
      return this.item.children && this.item.children.length;
    }
  },
  methods: {
    toggle: function () {
      if (this.isFolder) {
        this.isOpen = !this.isOpen;
      }
    }
  }
}
</script>

<style scoped>
ul {
  list-style-type: none;
}
.btn-action {
  cursor: pointer;
}
.item-name {
  cursor: move; /* fallback if grab cursor is unsupported */
  cursor: grab;
}
li {
  position: relative;
  border-left: 1px dashed #0d86ff;
}
.pre-children {
  color: #0d86ff;
}
.add {
  border-left: 1px dashed #0d86ff;
}

</style>