declare module 'vuetify/es5/components/*';

declare module 'vuetify/es5/components/VDataTable' {
  export interface IDataTablePagination {
    descending: boolean;
    page: number;
    rowsPerPage: number; // -1 a for All
    sortBy: string | null;
    totalItems: number | null;
  }
}
