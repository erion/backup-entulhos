unit USolicitacaoBilhete;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, Mask, ExtCtrls, ComCtrls, DBCtrls, Grids, DBGrids;

type
  TfrmSolicitacaoBilhete = class(TForm)
    StatusBar1: TStatusBar;
    Panel1: TPanel;
    Label1: TLabel;
    Label2: TLabel;
    Label3: TLabel;
    Label4: TLabel;
    Label5: TLabel;
    Label6: TLabel;
    Edit1: TEdit;
    MaskEdit1: TMaskEdit;
    Edit2: TEdit;
    Edit3: TEdit;
    ComboBox1: TComboBox;
    Memo1: TMemo;
    Label7: TLabel;
    GroupBox1: TGroupBox;
    DBGrid1: TDBGrid;
    DBNavigator1: TDBNavigator;
    Edit4: TEdit;
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  frmSolicitacaoBilhete: TfrmSolicitacaoBilhete;

implementation

{$R *.dfm}

end.
