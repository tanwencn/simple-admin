/**
 * Copyright (c) 2017-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

module.exports = {
  title: 'Simple Admin',
  tagline: '',
  url: 'https://www.tanecn.com',
  baseUrl: '/',
  favicon: 'img/logo.png',
  organizationName: 'facebook', // Usually your GitHub org/user name.
  projectName: 'docusaurus', // Usually your repo name.
  themeConfig: {
    navbar: {
      title: 'Simple Admin',
      logo: {
        alt: 'Simple Admin',
        src: 'img/logo.png',
      },
      links: [
        {to: '/', label: '文档', position: 'left'},
        {to: 'https://demo.tanecn.com/admin', label: '演示', position: 'left'},
        {
          href: 'https://github.com/tanwencn/simple-admin',
          label: 'GitHub',
          position: 'right',
        },
      ],
    },
    sidebarCollapsible: false,
  },
  presets: [
    [
      '@docusaurus/preset-classic',
      {
        docs: {
          sidebarPath: require.resolve('./sidebars.js'),
          routeBasePath: '/', // Set this value to '/'.
          homePageId: 'introduction', // Set to existing document id.
        },
        theme: {
          customCss: require.resolve('./src/css/custom.css'),
        },
      },
    ],
  ],
};
